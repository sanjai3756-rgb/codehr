<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'view dashboard',
            'manage users',
            'manage departments',
            'manage designations',
            'manage employees',
            'manage attendance',
            'manage leaves',
            'manage payroll',
            'view reports',
            'manage settings',
            'employee panel',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $hr = Role::firstOrCreate(['name' => 'hr']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $employee = Role::firstOrCreate(['name' => 'employee']);

        $admin->givePermissionTo($permissions);

        $hr->givePermissionTo([
            'view dashboard',
            'manage departments',
            'manage designations',
            'manage employees',
            'manage attendance',
            'manage leaves',
            'view reports',
            'employee panel',
        ]);

        $manager->givePermissionTo([
            'view dashboard',
            'manage employees',
            'manage attendance',
            'manage leaves',
            'view reports',
            'employee panel',
        ]);

        $employee->givePermissionTo([
            'view dashboard',
            'employee panel',
        ]);

        $user = User::where('email', 'admin@example.com')->first();

        if ($user) {
            $user->assignRole('admin');
        }
    }
}
