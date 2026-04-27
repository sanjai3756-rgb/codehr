<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\Payroll;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();

        $presentToday = Attendance::whereDate('date', Carbon::today())
            ->where('status', 'Present')
            ->count();

        $absentToday = Attendance::whereDate('date', Carbon::today())
            ->where('status', 'Absent')
            ->count();

        $pendingLeaves = LeaveRequest::where('status', 'Pending')->count();

        $monthlyPayroll = Payroll::sum('net_salary');

        return view('dashboard', compact(
            'totalEmployees',
            'presentToday',
            'absentToday',
            'pendingLeaves',
            'monthlyPayroll'
        ));
    }
}