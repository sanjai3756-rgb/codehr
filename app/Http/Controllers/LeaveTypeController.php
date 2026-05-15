<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveType;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $leaveTypes = LeaveType::latest()->get();

        return view(
            'leave_types.index',
            compact('leaveTypes')
        );
    }


    public function create()
    {
        return view('leave_types.create');
    }


    public function store(Request $request)
    {
        $request->validate([

            'leave_name' => 'required',

            'days' => 'required'

        ]);


        LeaveType::create([

            'leave_name' => $request->leave_name,

            'days' => $request->days

        ]);


        return redirect()
            ->route('leave-types.index')
            ->with(
                'success',
                'Leave Type Added'
            );
    }


    public function edit(LeaveType $leaveType)
    {
        return view(
            'leave_types.edit',
            compact('leaveType')
        );
    }


    public function update(
        Request $request,
        LeaveType $leaveType
    )
    {
        $leaveType->update([

            'leave_name' => $request->leave_name,

            'days' => $request->days

        ]);


        return redirect()
            ->route('leave-types.index')
            ->with(
                'success',
                'Leave Type Updated'
            );
    }


    public function destroy(LeaveType $leaveType)
    {
        $leaveType->delete();

        return back()->with(
            'success',
            'Leave Type Deleted'
        );
    }
}