<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionController extends Controller
{
public function index(Request $request)
{
    $roles = \Spatie\Permission\Models\Role::all();
    $permissions = \Spatie\Permission\Models\Permission::all();

    $user = null;

    if($request->user_id){
        $user = \App\Models\User::find($request->user_id);
    }

    return view('permissions.index', compact('roles','permissions','user'));
}
    public function assign(Request $request)
    {
        $role = Role::findById($request->role_id);

        $role->syncPermissions($request->permissions ?? []);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return back()->with('success', 'Permissions Updated');
    }
}