<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\Payroll;
use Carbon\Carbon;

class EmployeePanelController extends Controller
{
    public function dashboard()
    {
        return view('employees.dashboard');
    }

   public function profile()
{
    $employee = Employee::where('email', auth()->user()->email)->first();

    return view('employees.profile', compact('employee'));
}

    public function attendance()
    {
        $employee = Employee::where('user_id', auth()->id())->first();

        $rows = Attendance::where('employee_id', $employee->id ?? 0)->get();

        return view('employees.attendance', compact('rows'));
    }

    public function punchPage()
    {
        $employee = Employee::where('user_id', auth()->id())->first();

        $today = Attendance::where('employee_id', $employee->id ?? 0)
            ->whereDate('date', now()->toDateString())
            ->first();

        return view('employees.punch', compact('today'));
    }

    public function punchIn()
    {
        $employee = Employee::where('user_id', auth()->id())->first();

        if (!$employee) {
            return back()->with('success', 'Employee record not found');
        }

        $exists = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', now()->toDateString())
            ->first();

        if ($exists) {
            return back()->with('success', 'Already Punched In');
        }

        Attendance::create([
            'employee_id' => $employee->id,
            'date'       => now()->toDateString(),
            'status'     => 'Present',
            'check_in'   => now()->format('H:i:s'),
        ]);

        return back()->with('success', 'Punched In');
    }

    public function punchOut()
    {
        $employee = Employee::where('user_id', auth()->id())->first();

        $row = Attendance::where('employee_id', $employee->id ?? 0)
            ->whereDate('date', now()->toDateString())
            ->first();

        if ($row) {
            $row->update([
                'check_out' => now()->format('H:i:s')
            ]);
        }

        return back()->with('success', 'Punched Out');
    }

    public function leaves()
    {
        $employee = Employee::where('user_id', auth()->id())->first();

        $rows = LeaveRequest::where('employee_id', $employee->id ?? 0)->get();

        return view('employees.leaves', compact('rows'));
    }

    public function applyLeave()
    {
        return view('employees.apply-leave');
    }

    public function storeLeave(Request $request)
    {
        $employee = Employee::where('user_id', auth()->id())->first();

        if (!$employee) {
            return back();
        }

        LeaveRequest::create([
            'employee_id' => $employee->id,
            'leave_type'  => $request->leave_type,
            'from_date'   => $request->from_date,
            'to_date'     => $request->to_date,
            'reason'      => $request->reason,
            'status'      => 'Pending'
        ]);

        return redirect('/my-leaves')
            ->with('success', 'Leave Applied Successfully');
    }

    public function payslip()
    {
        $employee = Employee::where('user_id', auth()->id())->first();

        $rows = Payroll::where('employee_id', $employee->id ?? 0)->get();

        return view('employees.payslip', compact('rows'));
    }

    public function updatePhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|max:15'
        ]);

        $employee = Employee::where('user_id', auth()->id())->first();

        if ($employee) {
            $employee->phone = $request->phone;
            $employee->save();
        }

        return back()->with('success', 'Phone Number Updated Successfully');
    }

   public function updateProfile(Request $request)
{
    $employee = Employee::where('email', auth()->user()->email)->first();

    if (!$employee) {
        return back();
    }

    $employee->phone = $request->phone;

    if ($request->hasFile('photo')) {

        $file = $request->file('photo');
        $name = time().'.'.$file->getClientOriginalExtension();

        $file->move(public_path('uploads/profile'), $name);

        $employee->photo = $name;
    }

    $employee->save();

    return back()->with('success', 'Profile Updated Successfully');
}
}