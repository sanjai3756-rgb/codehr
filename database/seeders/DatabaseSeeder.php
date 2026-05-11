<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Call Role + Permission Seeder
        $this->call(RolePermissionSeeder::class);

        // 🔥 ADMIN
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123456'),
            ]
        );

        $admin->assignRole('admin');

        // 🔥 HR
        $hr = User::firstOrCreate(
            ['email' => 'hr@gmail.com'],
            [
                'name' => 'HR',
                'password' => Hash::make('123456'),
            ]
        );

        $hr->assignRole('hr');

        // 🔥 EMPLOYEE
        $emp = User::firstOrCreate(
            ['email' => 'emp@gmail.com'],
            [
                'name' => 'Employee',
                'password' => Hash::make('123456'),
            ]
        );

        $emp->assignRole('employee');
    }
}