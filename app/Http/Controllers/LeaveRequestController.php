<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $leaves = LeaveRequest::with('employee')->latest()->get();
        return view('leaves.index', compact('leaves'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('leaves.create', compact('employees'));
    }

    public function store(Request $request)
    {
        LeaveRequest::create($request->all());

        return redirect()->route('leaves.index')
            ->with('success','Leave Applied');
    }

    public function edit(LeaveRequest $leave)
    {
        return view('leaves.edit', compact('leave'));
    }

    public function update(Request $request, LeaveRequest $leave)
    {
        $leave->update($request->all());

        return redirect()->route('leaves.index')
            ->with('success','Updated');
    }
}