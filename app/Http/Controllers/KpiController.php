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



        $evaluated = KpiReview::whereMonth(
            'created_at',
            now()->month
        )->count();



        $top = KpiReview::where(
            'total_score',
            '>=',
            80
        )->count();



        $pending = $employees - $evaluated;



        $topEmployees = User::with(
            'designation'
        )->latest()->take(10)->get();



        return view(
            'kpi.dashboard',
            compact(
                'employees',
                'evaluated',
                'top',
                'pending',
                'topEmployees'
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
    ->where(
        'role',
        $employee->designation->designation_name
    )
    ->first();

    dd(
        $template->categories
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
            'Please select at least one report'
        );

    }

  $reports = KpiReview::with([
    'employee',
    'evaluator',
    'scores.question'
   ])
    ->whereIn('id',$request->report_ids)
   ->get();

    $pdf = Pdf::loadView(
        'kpi.bulk_pdf',
        compact('reports')
    );

    return $pdf->download(
        'Bulk_KPI_Report.pdf'
    );
}


    }