<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
  public function index()
{
    $attendances = Attendance::with('employee')->latest()->get();
    return view('attendances.index', compact('attendances'));
}

    public function create()
    {
        $employees = Employee::all();
        return view('attendances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        Attendance::create($request->all());

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance Marked');
    }
    
}