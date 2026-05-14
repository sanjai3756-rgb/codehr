<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
       $designations = Designation::with('department')
                ->latest()
                ->get();

        return view(
            'designations.index',
            compact('designations')
        );
    }



    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

public function create()
{
    $departments = \App\Models\Department::all();

    return view(
        'designations.create',
        compact('departments')
    );
}

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
$request->validate([

    'department_id' => 'required',

    'designation_name' => 'required'

]);

    Designation::create([

    'department_id' => $request->department_id,

    'designation_name' => $request->designation_name

]);


        return redirect()
            ->route('designations.index')
            ->with(
                'success',
                'Designation Added Successfully'
            );
    }



    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Designation $designation)
    {
        return view(
            'designations.edit',
            compact('designation')
        );
    }



    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Designation $designation
    )
    {
  $request->validate([

    'department_id' => 'required',

    'designation_name' => 'required'

]);

        $designation->update([

            'designation_name' =>
                $request->designation_name

        ]);


        return redirect()
            ->route('designations.index')
            ->with(
                'success',
                'Designation Updated Successfully'
            );
    }



    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Designation $designation)
    {
        $designation->delete();

        return back()->with(
            'success',
            'Designation Deleted Successfully'
        );
    }
}