<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department','designation')->latest()->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        $designations = Designation::all();

        return view('employees.create', compact('departments','designations'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if($request->hasFile('photo'))
        {
            $file = $request->file('photo');
            $name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $name);
            $data['photo'] = $name;
        }

        Employee::create($data);

        return redirect()->route('employees.index')
        ->with('success','Employee Added');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return back();
    }
}