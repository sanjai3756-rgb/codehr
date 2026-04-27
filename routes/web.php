<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\EmployeePanelController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Common Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [EmployeePanelController::class, 'profile']);

});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    });

    Route::resource('users', UserController::class);

    Route::resource('departments', DepartmentController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('leaves', LeaveRequestController::class);
    Route::resource('payrolls', PayrollController::class);

});

/*
|--------------------------------------------------------------------------
| HR Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:hr'])->group(function () {

    Route::get('/hr/dashboard', function () {
        return view('dashboard');
    });

    Route::resource('employees', EmployeeController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('leaves', LeaveRequestController::class);
    Route::resource('payrolls', PayrollController::class);


});

/*
|--------------------------------------------------------------------------
| Employee Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:employee'])->group(function () {

    Route::get('/employee/dashboard', [EmployeePanelController::class, 'dashboard']);

    Route::get('/my-attendance', [EmployeePanelController::class, 'attendance']);

    Route::get('/my-leaves', [EmployeePanelController::class, 'leaves']);
    Route::get('/punch', [EmployeePanelController::class,'punchPage']);
    Route::post('/punch-in', [EmployeePanelController::class,'punchIn']);
    Route::post('/punch-out', [EmployeePanelController::class,'punchOut']);
    Route::get('/my-payslip', [EmployeePanelController::class, 'payslip']);
    Route::get('/apply-leave', [EmployeePanelController::class,'applyLeave']);
    Route::post('/apply-leave', [EmployeePanelController::class,'storeLeave']);

});