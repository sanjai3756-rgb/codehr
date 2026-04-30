<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\LeaveRequest;

class ReportController extends Controller
{
    public function attendance(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        $query = Attendance::query();

        if($month){
            $query->whereMonth('created_at',$month);
        }

        if($year){
            $query->whereYear('created_at',$year);
        }

        $present = (clone $query)->where('status','Present')->count();
        $absent = (clone $query)->where('status','Absent')->count();

        return view('reports.attendance', compact(
            'present','absent','month','year'
        ));
    }

public function payroll(Request $request)
{
    $month = $request->month;
    $year = $request->year;

    $query = Payroll::query();

    if($month){
        $query->whereMonth('created_at',$month);
    }

    if($year){
        $query->whereYear('created_at',$year);
    }

    $total = $query->sum('net_salary');
    $count = $query->count();

    return view('reports.payroll', compact(
        'total','count'
    ));
}

public function leaves(Request $request)
{
    $month = $request->month;
    $year = $request->year;

    $query = LeaveRequest::query();

    if($month){
        $query->whereMonth('created_at',$month);
    }

    if($year){
        $query->whereYear('created_at',$year);
    }

    $pending = (clone $query)->where('status','Pending')->count();
    $approved = (clone $query)->where('status','Approved')->count();
    $rejected = (clone $query)->where('status','Rejected')->count();

    return view('reports.leaves', compact(
        'pending','approved','rejected'
    ));
}
}