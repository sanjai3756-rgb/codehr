<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()

    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('users.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles([$request->role]);

        if ($request->permissions) {
            $user->syncPermissions($request->permissions);
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect()->route('users.index')
            ->with('success', 'User Created');
    }

public function edit(User $user)
{
    return view('users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    return redirect()->route('users.index')
        ->with('success', 'User Updated');
}

public function destroy(User $user)
    {
        $user->delete();

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return back()->with('success', 'User Deleted');
    }
}