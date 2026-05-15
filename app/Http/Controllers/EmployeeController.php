<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

public function index()
{
    $employees = \App\Models\User::with(
        'designation'
    )->latest()->get();


    return view(
        'employees.index',
        compact('employees')
    );
}


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $departments = Department::all();

        $designations = Designation::all();

        return view(
            'employees.create',
            compact(
                'departments',
                'designations'
            )
        );
    }



    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $data = $request->validate([

            'employee_id'    => 'required',

            'name'           => 'required',

            'email'          => 'required|email',

            'phone'          => 'nullable',

            'department_id'  => 'required',

            'designation_id' => 'required',

            'joining_date'   => 'nullable',

            'salary'         => 'required',

            'photo'          => 'nullable|image',

            'address'        => 'nullable',

        ]);


        /*
        |--------------------------------------------------------------------------
        | PHOTO UPLOAD
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo'))
        {
            $file = $request->file('photo');

            $name = time() . '.'
                  . $file->getClientOriginalExtension();

            $file->move(
                public_path('uploads'),
                $name
            );

            $data['photo'] = $name;
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE EMPLOYEE
        |--------------------------------------------------------------------------
        */

        Employee::create($data);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('employees.index')
            ->with(
                'success',
                'Employee Added Successfully'
            );
    }



    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Employee $employee)
    {
        $departments = Department::all();

        $designations = Designation::all();

        return view(
            'employees.edit',
            compact(
                'employee',
                'departments',
                'designations'
            )
        );
    }



    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Employee $employee
    )
    {
        $data = $request->validate([

            'employee_id'    => 'required',

            'name'           => 'required',

            'email'          => 'required|email',

            'phone'          => 'nullable',

            'department_id'  => 'required',

            'designation_id' => 'required',

            'joining_date'   => 'nullable',

            'salary'         => 'required',

            'photo'          => 'nullable|image',

            'address'        => 'nullable',

        ]);


        /*
        |--------------------------------------------------------------------------
        | PHOTO UPDATE
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo'))
        {
            $file = $request->file('photo');

            $name = time() . '.'
                  . $file->getClientOriginalExtension();

            $file->move(
                public_path('uploads'),
                $name
            );

            $data['photo'] = $name;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE EMPLOYEE
        |--------------------------------------------------------------------------
        */

        $employee->update($data);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('employees.index')
            ->with(
                'success',
                'Employee Updated Successfully'
            );
    }



    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return back()->with(
            'success',
            'Employee Deleted Successfully'
        );
    }
}