<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\KpiAssignment;

class KpiAssignmentController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {

        /*
        |--------------------------------------------------------------------------
        | ALL STAFFS AS EVALUATORS
        |--------------------------------------------------------------------------
        */

        $evaluators = User::with(
            'designation'
        )
        ->orderBy('name')
        ->get();



        /*
        |--------------------------------------------------------------------------
        | EMPLOYEES
        |--------------------------------------------------------------------------
        */

        $employees = User::with(
            'designation'
        )
        ->orderBy('name')
        ->get();



        /*
        |--------------------------------------------------------------------------
        | ASSIGNMENTS
        |--------------------------------------------------------------------------
        */

        $assignments = KpiAssignment::with(
            'evaluator',
            'employee'
        )
        ->latest()
        ->get();



        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(

            'kpi.assignments',

            compact(

                'evaluators',
                'employees',
                'assignments'

            )

        );

    }



    /*
    |--------------------------------------------------------------------------
    | STORE KPI ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'evaluator_id' => 'required',

            'employee_id' => 'required|array',

            'month' => 'required',

            'year' => 'required'

        ]);



        /*
        |--------------------------------------------------------------------------
        | BULK ASSIGN
        |--------------------------------------------------------------------------
        */

        foreach($request->employee_id as $employee){

            KpiAssignment::create([

                'evaluator_id' => $request->evaluator_id,

                'employee_id' => $employee,

                'month' => $request->month,

                'year' => $request->year

            ]);

        }



        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return back()->with(

            'success',

            'Bulk KPI Assigned Successfully'

        );

    }

}