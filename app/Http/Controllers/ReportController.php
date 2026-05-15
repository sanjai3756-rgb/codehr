<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\LeaveModel;
use App\Models\Payroll;
use App\Models\Employee;
use App\Models\LeaveRequest;

class ReportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ATTENDANCE REPORT
    |--------------------------------------------------------------------------
    */

    public function attendance()
    {
        $attendances = Attendance::with('employee')
                        ->latest()
                        ->get();


        $totalEmployees = Employee::count();


        $presentToday = Attendance::whereDate(
                                'date',
                                now()
                            )
                            ->where('status','Present')
                            ->count();


        $absentToday = Attendance::whereDate(
                                'date',
                                now()
                            )
                            ->where('status','Absent')
                            ->count();


        return view(
            'reports.attendance',
            compact(
                'attendances',
                'totalEmployees',
                'presentToday',
                'absentToday'
            )
        );
    }






  public function leaves()
{
    $leaves = \App\Models\LeaveRequest::with('employee')
                ->latest()
                ->get();


    $totalRequests = \App\Models\LeaveRequest::count();

    $approved = \App\Models\LeaveRequest::where(
                    'status',
                    'Approved'
                )->count();

    $pending = \App\Models\LeaveRequest::where(
                    'status',
                    'Pending'
                )->count();


    return view(
        'reports.leaves',
        compact(
            'leaves',
            'totalRequests',
            'approved',
            'pending'
        )
    );
}

public function payroll()
{
    $payrolls = \App\Models\Payroll::with('employee')
                    ->latest()
                    ->get();


    /*
    |--------------------------------------------------------------------------
    | REPORT CARDS
    |--------------------------------------------------------------------------
    */

$totalPayroll = Payroll::sum('basic_salary');

    $totalBonus = 0;


    $employeesPaid = \App\Models\Payroll::count();



    /*
    |--------------------------------------------------------------------------
    | RETURN VIEW
    |--------------------------------------------------------------------------
    */

    return view(
        'reports.payroll',
        compact(
            'payrolls',
            'totalPayroll',
            'totalBonus',
            'employeesPaid'
        )
    );
}
}