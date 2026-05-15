<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->get();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

public function store(Request $request)
{
    $request->validate([

        'department_name' => 'required'

    ]);


    Department::create([

        'department_name' =>
            $request->department_name

    ]);


    return redirect()
        ->route('departments.index')
        ->with(
            'success',
            'Department Added Successfully'
        );
}

  public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

public function update(
    Request $request,
    Department $department
)
{
    $request->validate([

        'department_name' => 'required'

    ]);


    $department->update([

        'department_name' =>
            $request->department_name

    ]);


    return redirect()
        ->route('departments.index')
        ->with(
            'success',
            'Department Updated Successfully'
        );
}

public function destroy(Department $department)
    {
        $department->delete();

        return back()->with('success', 'Deleted Successfully');
    }
}