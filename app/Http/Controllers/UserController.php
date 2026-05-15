<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Designation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class UserController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $users = User::with('designation')
                    ->latest()
                    ->get();

        return view(
            'users.index',
            compact('users')
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

        $permissions = Permission::all();


        return view(
            'users.create',
            compact(
                'departments',
                'designations',
                'permissions'
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
        $request->validate([

            'name' => 'required',

            'email' =>
            'required|email|unique:users,email',

            'password' => 'required'

        ]);


        /*
        |--------------------------------------------------------------------------
        | PHOTO
        |--------------------------------------------------------------------------
        */

        if($request->hasFile('photo'))
        {
            $file = $request->file('photo');

            $name = time().'.'.$file
                                  ->getClientOriginalExtension();

            $file->move(
                public_path('uploads/users'),
                $name
            );

            $photo = $name;
        }
        else{
            $photo = null;
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE USER
        |--------------------------------------------------------------------------
        */

        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'password' => Hash::make(
                $request->password
            ),

            'designation_id' =>
                $request->designation_id,

            'employee_id' =>
                $request->employee_id,

            'salary' =>
                $request->salary,

            'joining_date' =>
                $request->joining_date,

            'photo' => $photo

        ]);


        /*
        |--------------------------------------------------------------------------
        | PERMISSIONS
        |--------------------------------------------------------------------------
        */

        if($request->permissions)
        {
            $user->syncPermissions(

                $request->permissions

            );
        }


        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User Created Successfully'
            );
    }



    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(User $user)
    {
        $departments = Department::all();

        $designations = Designation::all();

        $permissions = Permission::all();


        return view(
            'users.edit',
            compact(
                'user',
                'departments',
                'designations',
                'permissions'
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
        User $user
    )
    {
        $request->validate([

            'name' => 'required',

            'email' =>
            'required|email|unique:users,email,'.$user->id

        ]);


        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $data = [

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'designation_id' =>
                $request->designation_id,

            'employee_id' =>
                $request->employee_id,

            'salary' =>
                $request->salary,

            'joining_date' =>
                $request->joining_date

        ];


        /*
        |--------------------------------------------------------------------------
        | PASSWORD
        |--------------------------------------------------------------------------
        */

        if($request->password)
        {
            $data['password'] =
                Hash::make($request->password);
        }


        /*
        |--------------------------------------------------------------------------
        | PHOTO
        |--------------------------------------------------------------------------
        */

        if($request->hasFile('photo'))
        {
            $file = $request->file('photo');

            $name = time().'.'.$file
                                  ->getClientOriginalExtension();

            $file->move(
                public_path('uploads/users'),
                $name
            );

            $data['photo'] = $name;
        }


        $user->update($data);


        /*
        |--------------------------------------------------------------------------
        | UPDATE PERMISSIONS
        |--------------------------------------------------------------------------
        */

        $user->syncPermissions(

            $request->permissions ?? []

        );


        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User Updated Successfully'
            );
    }



    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(User $user)
    {
        $user->delete();

        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();


        return back()->with(
            'success',
            'User Deleted Successfully'
        );
    }
}