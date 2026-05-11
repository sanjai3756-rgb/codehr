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
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect('/login'));

Route::get('/login', [AuthController::class,'loginForm'])->name('login');
Route::post('/login', [AuthController::class,'login']);

Route::get('/logout', [AuthController::class,'logout'])->middleware('auth');


/*
|--------------------------------------------------------------------------
| COMMON
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {

        if(auth()->user()->hasRole('admin')) {
            return redirect('/admin/dashboard');
        }

        if(auth()->user()->hasRole('hr')) {
            return redirect('/hr/dashboard');
        }

        if(auth()->user()->hasRole('employee')) {
            return redirect('/employee/dashboard');
        }

        abort(403);

    });

});


/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class,'admin']);

    Route::resource('users', UserController::class);

    Route::resource('departments', DepartmentController::class);

    Route::resource('designations', DesignationController::class);

    Route::get('/reports/attendance', [ReportController::class,'attendance']);

    Route::get('/reports/payroll', [ReportController::class,'payroll']);

    Route::get('/reports/leaves', [ReportController::class,'leaves']);

});


/*
|--------------------------------------------------------------------------
| ADMIN + HR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:admin|hr'])->group(function () {

    Route::get('/hr/dashboard', [DashboardController::class,'hr']);

    Route::resource('employees', EmployeeController::class);

    Route::resource('attendances', AttendanceController::class);

    Route::resource('leaves', LeaveRequestController::class);

    Route::resource('payrolls', PayrollController::class);

});


/*
|--------------------------------------------------------------------------
| EMPLOYEE ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:employee'])->group(function () {

    Route::get('/employee/dashboard', [DashboardController::class,'employee']);

    Route::get('/profile', [EmployeePanelController::class,'profile']);

    Route::get('/my-attendance', [EmployeePanelController::class,'attendance']);

    Route::get('/my-leaves', [EmployeePanelController::class,'leaves']);

    Route::get('/my-payslip', [EmployeePanelController::class,'payslip']);

    Route::get('/punch', [EmployeePanelController::class,'punchPage']);

    Route::post('/punch-in', [EmployeePanelController::class,'punchIn']);

    Route::post('/punch-out', [EmployeePanelController::class,'punchOut']);

    Route::get('/apply-leave', [EmployeePanelController::class,'applyLeave']);

    Route::post('/apply-leave', [EmployeePanelController::class,'storeLeave']);

});