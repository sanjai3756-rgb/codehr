<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\LeaveRequest;
use App\Models\Attendance;
use App\Models\Payroll;

class DashboardController extends Controller
{
public function admin()
{
    $employees = Employee::count();
    $departments = Department::count();
    $leaves = LeaveRequest::where('status','Pending')->count();
    $payrolls = Payroll::count();

    $monthly = Employee::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->groupBy('month')
        ->pluck('total','month')
        ->toArray();

    $chartData = [];

    for($i=1; $i<=12; $i++){
        $chartData[] = $monthly[$i] ?? 0;
    }

    $pendingLeaves  = LeaveRequest::where('status','Pending')->count();
    $approvedLeaves = LeaveRequest::where('status','Approved')->count();
    $rejectedLeaves = LeaveRequest::where('status','Rejected')->count();

    return view('dashboard.admin', compact(
        'employees',
        'departments',
        'leaves',
        'payrolls',
        'chartData',
        'pendingLeaves',
        'approvedLeaves',
        'rejectedLeaves'
    ));
}

    public function hr()
    {
        return view('dashboard.hr',[
            'employees' => Employee::count(),
            'attendance' => Attendance::count(),
            'leaves' => LeaveRequest::where('status','Pending')->count(),
        ]);
    }

    public function employee()
    {
        return view('dashboard.employee');
    }
}