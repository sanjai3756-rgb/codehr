<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\KpiEvaluation;
use App\Models\KpiTemplate;
use App\Models\KpiReview;
use App\Models\KpiReviewScore;
use App\Models\KpiAssignment;
use Barryvdh\DomPDF\Facade\Pdf;

class KpiController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | KPI DASHBOARD
    |--------------------------------------------------------------------------
    */

public function dashboard()
{
    $employees = User::count();

    $evaluated = KpiReview::count();

    $top = KpiReview::where(
        'total_score',
        '>=',
        80
    )->count();

    $pending = $employees - $evaluated;

    $highestEmployees = KpiReview::with('employee')
        ->orderByDesc('total_score')
        ->take(3)
        ->get();

    $lowestEmployees = KpiReview::with('employee')
        ->orderBy('total_score')
        ->take(3)
        ->get();

    return view(
        'kpi.dashboard',
        compact(
            'employees',
            'evaluated',
            'top',
            'pending',
            'highestEmployees',
            'lowestEmployees'
        )
    );
}
    /*
    |--------------------------------------------------------------------------
    | EMPLOYEE KPI
    |--------------------------------------------------------------------------
    */

    public function index()
    {

        $employees = User::with(
            'designation'
        )->latest()->get();


        return view(
            'kpi.index',
            compact('employees')
        );

    }



    /*
    |--------------------------------------------------------------------------
    | KPI REPORTS
    |--------------------------------------------------------------------------
    */

public function reports(Request $request)
{

    $reports = KpiReview::with([
        'employee.designation',
        'evaluator'
    ]);



    if($request->filled('employee')){

        $reports->whereHas(
            'employee',
            function($q) use ($request){

                $q->where(
                    'name',
                    'like',
                    '%'.$request->employee.'%'
                );

            }
        );

    }



    if($request->filled('month')){

        $reports->where(
            'month',
            $request->month
        );

    }



    $reports = $reports
        ->latest()
        ->get();



    return view(
        'kpi.reports',
        compact('reports')
    );

}

    /*
    |--------------------------------------------------------------------------
    | KPI EVALUATION PAGE
    |--------------------------------------------------------------------------
    */
public function evaluate($id)
{
    $employee = User::with(
        'designation'
    )->findOrFail($id);

    $template = KpiTemplate::with(
        'categories.questions'
    )
    ->whereRaw(
        'LOWER(role) = ?',
        [
            strtolower(
                $employee->designation->designation_name
            )
        ]
    )
    ->first();

    if (!$template) {

        return back()->with(
            'error',
            'No KPI Template Found For : '
            .$employee->designation->designation_name
        );
    }

    return view(
        'kpi.evaluate',
        compact(
            'employee',
            'template'
        )
    );
}

public function submitEvaluation(Request $request)
{

    $employee = User::findOrFail(
        $request->employee_id
    );
    
    
    $review = KpiReview::create([

        'employee_id' => $employee->id,

        'evaluator_id' => auth()->id(),

        'month' => date('F'),

        'year' => date('Y'),

        'total_score' => $request->final_score

    ]);

    $request->validate([
    'employee_id' => 'required',
    'question_id' => 'required|array',
    'week1' => 'required|array',
    'week2' => 'required|array',

]);
foreach($request->question_id as $index => $questionId){

    KpiReviewScore::create([

        'review_id' =>
            $review->id,

        'question_id' =>
            $questionId,

        'week1' =>
            $request->week1[$index],

        'week2' =>
            $request->week2[$index],

        'average' =>
            $request->average[$index]

    ]);



    }


    $employee->update([

        'kpi_total' =>
            $request->final_score

    ]);


    return redirect()
        ->route('kpi.reports')
        ->with(
            'success',
            'KPI Submitted Successfully'
        );
}

// kpi download


public function downloadPdf($id)
{
    $report = KpiReview::with([
        'employee',
        'evaluator',
        'scores.question'
    ])->findOrFail($id);

    $pdf = Pdf::loadView(
        'kpi.pdf',
        compact('report')
    );

    return $pdf->download(
        'KPI_Report_'.$report->employee->name.'.pdf'
    );
}

public function bulkPdf(Request $request)
{
    if(
        !$request->has('report_ids')
        ||
        empty($request->report_ids)
    ){
        return back()->with(
            'error',
            'Please select reports'
        );
    }

    $reports = KpiReview::with([
        'employee',
        'evaluator',
        'scores.question'
    ])
    ->whereIn(
        'id',
        $request->report_ids
    )
    ->get();

    $pdf = Pdf::loadView(
        'kpi.bulk_pdf',
        compact('reports')
    );

    return $pdf->download(
        'KPI_Reports.pdf'
    );
}

// kpi edit report
public function editReport($id)
{
    $report = KpiReview::with(
        'scores.question',
        'employee'
    )->findOrFail($id);
    return view(
        'kpi.edit_report',
        compact('report')
    );
}

// kpi update report
public function updateReport(Request $request,$id)
{
    $report = KpiReview::findOrFail($id);

    $report->update([

        'total_score' =>
            $request->final_score

    ]);

    return redirect()
        ->route('kpi.reports')
        ->with(
            'success',
            'Report Updated Successfully'
        );
}

// kpi delete report
public function deleteReport($id)
{
    KpiReviewScore::where(
        'review_id',
        $id
    )->delete();

    KpiReview::findOrFail($id)
        ->delete();

    return redirect()
        ->route('kpi.reports')
        ->with(
            'success',
            'KPI Report Deleted Successfully'
        );
}
    }