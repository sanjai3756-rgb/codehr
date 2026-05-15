<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Spatie\Permission\PermissionRegistrar;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $permissions = Permission::all();

        $user = User::findOrFail(
            $request->user_id
        );

        $role = $user->roles->first();

        return view(
            'permissions.index',
            compact(
                'permissions',
                'user',
                'role'
            )
        );
    }

public function update(Request $request)
{
    $user = User::findOrFail(
        $request->user_id
    );


    /*
    |--------------------------------------------------------------------------
    | UPDATE USER PERMISSIONS
    |--------------------------------------------------------------------------
    */

    $user->syncPermissions(

        $request->permissions ?? []

    );


    /*
    |--------------------------------------------------------------------------
    | CLEAR CACHE
    |--------------------------------------------------------------------------
    */

    app()[\Spatie\Permission\PermissionRegistrar::class]
        ->forgetCachedPermissions();


    return back()->with(

        'success',

        'Permissions Updated Successfully'

    );
}
}