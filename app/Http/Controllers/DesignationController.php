<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Department;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::with('department')->latest()->get();
        return view('designations.index', compact('designations'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('designations.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'designation_name' => 'required'
        ]);

        Designation::create($request->all());

        return redirect()->route('designations.index')
            ->with('success', 'Added Successfully');
    }

    public function edit(Designation $designation)
    {
        $departments = Department::all();
        return view('designations.edit', compact('designation', 'departments'));
    }

    public function update(Request $request, Designation $designation)
    {
        $designation->update($request->all());

        return redirect()->route('designations.index')
            ->with('success', 'Updated Successfully');
    }

    public function destroy(Designation $designation)
    {
        $designation->delete();

        return back()->with('success', 'Deleted Successfully');
    }
}