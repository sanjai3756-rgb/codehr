<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeePanelController extends Controller
{
    public function dashboard()
    {
        return view('employee.dashboard');
    }

public function profile()
{
    return view('employee.profile');
}
    public function attendance()
    {
        $rows = Attendance::where('employee_id', Auth::id())->get();
        return view('employee.attendance', compact('rows'));
    }
    public function punchPage()
{
    $today = Attendance::where('employee_id', auth()->id())
        ->whereDate('date', now()->toDateString())
        ->first();

    return view('employee.punch', compact('today'));
}

public function punchIn()
{
    Attendance::firstOrCreate(
        [
            'employee_id' => auth()->id(),
            'date' => now()->toDateString(),
        ],
        [
            'status' => 'Present',
            'check_in' => now()->format('H:i:s'),
        ]
    );
{
    $exists = Attendance::where('employee_id', auth()->id())
        ->whereDate('date', now()->toDateString())
        ->first();

    if($exists){
        return back()->with('success','Already Punched In');
    }

    Attendance::create([
        'employee_id' => auth()->id(),
        'date' => now()->toDateString(),
        'status' => 'Present',
        'check_in' => now()->format('H:i:s'),
    ]);

    return back()->with('success','Punched In');
}
    return back()->with('success','Punched In');
}

public function punchOut()
{
    $row = Attendance::where('employee_id', auth()->id())
        ->whereDate('date', now()->toDateString())
        ->first();

    if($row){
        $row->update([
            'check_out' => now()->format('H:i:s')
        ]);
    }

    return back()->with('success','Punched Out');
}

    public function leaves()
    {
        $rows = LeaveRequest::where('employee_id', Auth::id())->get();
        return view('employee.leaves', compact('rows'));
    }
    public function applyLeave()
{
    return view('employee.apply-leave');
}

public function storeLeave(Request $request)
{
    LeaveRequest::create([
        'employee_id' => Auth::id(),
        'leave_type' => $request->leave_type,
        'from_date' => $request->from_date,
        'to_date' => $request->to_date,
        'reason' => $request->reason,
        'status' => 'Pending'
    ]);

    return redirect('/my-leaves')->with('success','Leave Applied Successfully');
}

    public function payslip()
    {
        $rows = Payroll::where('employee_id', Auth::id())->get();
        return view('employee.payslip', compact('rows'));
    }
}