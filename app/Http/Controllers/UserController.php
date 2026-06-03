<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\Shift;

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

    $shifts = Shift::where('status',1)->get();


    return view(
        'users.create',
        compact(
            'departments',
            'designations',
            'permissions',
            'shifts'
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

            'salary_type' => $request->salary_type,

            'hourly_rate' => $request->hourly_rate,

             'daily_rate' => $request->daily_rate,

            'joining_date' =>
                $request->joining_date,

            'photo' => $photo,

            'shift_id' => $request->shift_id,


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

            'salary_type' =>
             $request->salary_type,

             'hourly_rate' =>
            $request->hourly_rate,

            'daily_rate' =>
            $request->daily_rate,

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
            if ($request->role) {

               $user->syncRoles([
               $request->role
    ]);
    }


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

public function bulkShiftPage()
{
    $users = User::all();

    $shifts = Shift::all();


    return view(
        'users.bulk-shift',
        compact(
            'users',
            'shifts'
        )
    );
}


public function bulkShift(Request $request)
{

    $request->validate([

        'users'=>'required|array',

        'shift_id'=>'required'

    ]);


    User::whereIn(
        'id',
        $request->users
    )
    ->update([

        'shift_id'=>$request->shift_id

    ]);


    return back()
    ->with(
        'success',
        'Shift Assigned Successfully'
    );

}

}