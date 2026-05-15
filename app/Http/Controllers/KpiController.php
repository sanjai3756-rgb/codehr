<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\KpiAssignment;
use App\Models\KpiCategory;
use App\Models\KpiEvaluation;
use App\Models\KpiScore;

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


        $evaluated = KpiEvaluation::whereMonth(
            'created_at',
            date('m')
        )->count();


        $top = KpiEvaluation::where(
            'total_score',
            '>=',
            80
        )->count();


        $pending = User::count() - $evaluated;



        /*
        |--------------------------------------------------------------------------
        | TOP EMPLOYEES
        |--------------------------------------------------------------------------
        */

       $topEmployees = User::with(
      'designation'
       )
      ->get();



        /*
        |--------------------------------------------------------------------------
        | CHART DATA
        |--------------------------------------------------------------------------
        */

        $chartData = [

            'Jan' => 70,
            'Feb' => 82,
            'Mar' => 65,
            'Apr' => 90,
            'May' => 75,
            'Jun' => 88

        ];


        return view(
            'kpi.dashboard',
            compact(
                'employees',
                'evaluated',
                'top',
                'pending',
                'topEmployees',
                'chartData'
            )
        );
    }



    /*
    |--------------------------------------------------------------------------
    | KPI INDEX
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
    | KPI EVALUATION PAGE
    |--------------------------------------------------------------------------
    */

    public function evaluate($id)
    {

        $employee = User::with(
            'designation',
            'department'
        )->findOrFail($id);



        /*
        |--------------------------------------------------------------------------
        | ACCESS CONTROL
        |--------------------------------------------------------------------------
        */

        $allowed = KpiAssignment::where(

            'evaluator_id',
            auth()->id()

        )->where(

            'employee_id',
            $employee->id

        )->exists();



        /*
        |--------------------------------------------------------------------------
        | ADMIN FULL ACCESS
        |--------------------------------------------------------------------------
        */

        if(
            auth()->user()->designation &&
            auth()->user()->designation->designation_name != 'Admin'
        )
        {

            if(!$allowed)
            {
                abort(403);
            }

        }



        /*
        |--------------------------------------------------------------------------
        | GET KPI TEMPLATE
        |--------------------------------------------------------------------------
        */

        $categories = KpiCategory::with(
            'questions'
        )
        ->whereHas(
            'template',
            function($query) use ($employee)
            {
                $query->where(
                    'designation_id',
                    $employee->designation_id
                );
            }
        )->get();



        return view(
            'kpi.evaluate',
            compact(
                'employee',
                'categories'
            )
        );
    }



    /*
    |--------------------------------------------------------------------------
    | STORE KPI
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $employee = User::findOrFail(
            $request->employee_id
        );



        /*
        |--------------------------------------------------------------------------
        | CREATE EVALUATION
        |--------------------------------------------------------------------------
        */

        $evaluation = KpiEvaluation::create([

            'employee_id' => $employee->id,

            'evaluator_id' => auth()->id(),

            'month' => date('m'),

            'year' => date('Y'),

            'period' => now()->day <= 15
                            ? '1-15'
                            : '16-end',

            'total_score' => 0

        ]);



        /*
        |--------------------------------------------------------------------------
        | STORE SCORES
        |--------------------------------------------------------------------------
        */

        $total = 0;


        foreach($request->scores as $questionId => $score)
        {

            KpiScore::create([

                'kpi_evaluation_id' =>
                    $evaluation->id,

                'kpi_question_id' =>
                    $questionId,

                'score' => $score

            ]);


            $total += $score;
        }



        /*
        |--------------------------------------------------------------------------
        | UPDATE TOTAL
        |--------------------------------------------------------------------------
        */

        $evaluation->update([

            'total_score' => $total

        ]);



        return redirect()
            ->route('kpi.index')
            ->with(
                'success',
                'KPI Submitted Successfully'
            );
    }



    /*
    |--------------------------------------------------------------------------
    | VIEW KPI
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {

        $employee = User::with(
            'designation',
            'department'
        )->findOrFail($id);



        $evaluations = KpiEvaluation::where(
            'employee_id',
            $employee->id
        )
        ->latest()
        ->get();



        return view(
            'kpi.show',
            compact(
                'employee',
                'evaluations'
            )
        );
    }



public function reports()

{
    $reports = \App\Models\KpiEvaluation::with(

        'employee.designation'

    )
    ->latest()
    ->get();



    return view(

        'kpi.reports',

        compact('reports')

    );

    }
}
