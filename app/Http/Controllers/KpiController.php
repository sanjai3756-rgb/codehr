<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\KpiEvaluation;
use App\Models\KpiTemplate;
use App\Models\KpiReview;
use App\Models\KpiReviewScore;
use App\Models\KpiAssignment;

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

    public function reports()
    {

        $reports = KpiReview::with(
            'employee.designation'
        )->latest()->get();


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

    /*
    |--------------------------------------------------------------------------
    | EMPLOYEE
    |--------------------------------------------------------------------------
    */

    $employee = User::with(
        'designation'
    )->findOrFail($id);



    /*
    |--------------------------------------------------------------------------
    | DESIGNATION
    |--------------------------------------------------------------------------
    */

    $designation = strtolower(
        $employee
        ->designation
        ->designation_name ?? ''
    );



    /*
    |--------------------------------------------------------------------------
    | QUESTIONS
    |--------------------------------------------------------------------------
    */

    $questions = [];



    /*
    |--------------------------------------------------------------------------
    | TESTER KPI
    |--------------------------------------------------------------------------
    */

    if(str_contains($designation,'tester')){

        $questions = [

            'Test Case Coverage',
            'Bug Detection',
            'Bug Reporting',
            'Execution Speed',
            'Automation Skills',
            'API Testing',
            'Documentation',
            'Team Collaboration',
            'Communication',
            'Attendance'

        ];

    }



    /*
    |--------------------------------------------------------------------------
    | PHP KPI
    |--------------------------------------------------------------------------
    */

    elseif(str_contains($designation,'php')){

        $questions = [

            'Code Quality',
            'Laravel Knowledge',
            'Database Handling',
            'API Integration',
            'Bug Fixing',
            'Team Communication',
            'Task Completion',
            'Git Usage',
            'Optimization',
            'Attendance'

        ];

    }



    /*
    |--------------------------------------------------------------------------
    | FLUTTER KPI
    |--------------------------------------------------------------------------
    */

    elseif(str_contains($designation,'flutter')){

        $questions = [

            'UI Design',
            'Flutter Knowledge',
            'Firebase Usage',
            'API Integration',
            'Performance',
            'Bug Fixing',
            'Task Completion',
            'Play Store Build',
            'Code Quality',
            'Attendance'

        ];

    }



    /*
    |--------------------------------------------------------------------------
    | UI UX KPI
    |--------------------------------------------------------------------------
    */

    elseif(str_contains($designation,'ui')){

        $questions = [

            'Design Creativity',
            'Figma Usage',
            'Wireframe',
            'User Experience',
            'Color Theory',
            'Responsive Design',
            'Prototype',
            'Team Coordination',
            'Client Satisfaction',
            'Attendance'

        ];

    }



    /*
    |--------------------------------------------------------------------------
    | VIDEO EDITOR KPI
    |--------------------------------------------------------------------------
    */

    elseif(str_contains($designation,'video')){

        $questions = [

            'Editing Quality',
            'Creativity',
            'Transition Usage',
            'Audio Sync',
            'Color Grading',
            'Reel Editing',
            'Deadline Handling',
            'Team Coordination',
            'Client Satisfaction',
            'Attendance'

        ];

    }



    /*
    |--------------------------------------------------------------------------
    | HR KPI
    |--------------------------------------------------------------------------
    */

    elseif(str_contains($designation,'hr')){

        $questions = [

            'Hiring Process',
            'Employee Handling',
            'Communication',
            'Interview Management',
            'Documentation',
            'Attendance Tracking',
            'Problem Solving',
            'Reporting',
            'Team Support',
            'Attendance'

        ];

    }



    /*
    |--------------------------------------------------------------------------
    | DEFAULT KPI
    |--------------------------------------------------------------------------
    */

    else{

        $questions = [

            'Performance',
            'Communication',
            'Task Completion',
            'Quality',
            'Attendance'

        ];

    }



    return view(
        'kpi.evaluate',
        compact(
            'employee',
            'questions'
        )
    );

}
    }