<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\LeaveSettingController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\EmployeePanelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => redirect('/login'));

Route::get('/login', [AuthController::class, 'loginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])
    ->middleware('auth');


/*
|--------------------------------------------------------------------------
| COMMON
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {

        if (auth()->user()->hasRole('admin')) {
            return redirect('/admin/dashboard');
        }

        if (auth()->user()->hasRole('hr')) {
            return redirect('/hr/dashboard');
        }

        if (auth()->user()->hasRole('employee')) {
            return redirect('/employee/dashboard');
        }

        abort(403);

    });

});


/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->group(function () {

        Route::get(
            '/admin/dashboard',
            [DashboardController::class, 'admin']
        );

        Route::get(
            '/hr/dashboard',
            [DashboardController::class, 'hr']
        );

        Route::get(
            '/employee/dashboard',
            [DashboardController::class, 'employee']
        );

});


/*
|--------------------------------------------------------------------------
| USERS
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:manage users'
])->group(function () {

    Route::resource(
        'users',
        UserController::class
    );

});


/*
|--------------------------------------------------------------------------
| PERMISSIONS
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:manage permissions'
])->group(function () {

    Route::get(
        '/permissions',
        [PermissionController::class, 'index']
    );

    Route::post(
        '/permissions/update',
        [PermissionController::class, 'update']
    );

});
/*
|--------------------------------------------------------------------------
| DEPARTMENTS
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:manage departments'
])->group(function () {

    Route::resource(
        'departments',
        DepartmentController::class
    );

});


/*
|--------------------------------------------------------------------------
| DESIGNATIONS
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:manage designations'
])->group(function () {

    Route::resource(
        'designations',
        DesignationController::class
    );

});
Route::resource(
    'designations',
    DesignationController::class
);

/*
|--------------------------------------------------------------------------
| EMPLOYEES
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:manage employees'
])->group(function () {

    Route::resource(
        'employees',
        EmployeeController::class
    );

});


/*
|--------------------------------------------------------------------------
| ATTENDANCE
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:manage attendance'
])->group(function () {

    Route::resource(
        'attendances',
        AttendanceController::class
    );

});


/*
|--------------------------------------------------------------------------
| KPI
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:manage kpi'
])->group(function () {

    Route::get('/kpi-points', function () {

        return view('kpi.index');

    });

});


/*
|--------------------------------------------------------------------------
| PAYROLL
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:manage payroll'
])->group(function () {

    Route::resource(
        'payrolls',
        PayrollController::class
    );

});


/*
|--------------------------------------------------------------------------
| LEAVES
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:manage leaves'
])->group(function () {

    Route::resource(
        'leaves',
        LeaveRequestController::class
    );
   Route::resource(
    'leave-types',
    LeaveTypeController::class
);

Route::get(
    '/leave-settings',
    [LeaveSettingController::class,'index']
);

Route::post(
    '/leave-settings',
    [LeaveSettingController::class,'update']
);
});


/*
|--------------------------------------------------------------------------
| REPORTS
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'permission:view reports'
])->group(function () {

  Route::get(
    '/reports/attendance',
    [ReportController::class,'attendance']
);

Route::get(
    '/reports/leaves',
    [ReportController::class,'leaves']
);

Route::get(
    '/reports/payroll',
    [ReportController::class,'payroll']
);
});


/*
|--------------------------------------------------------------------------
| EMPLOYEE PANEL
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:employee'
])->group(function () {

    Route::get(
        '/profile',
        [EmployeePanelController::class, 'profile']
    );

    Route::get(
        '/my-attendance',
        [EmployeePanelController::class, 'attendance']
    );

    Route::get(
        '/my-leaves',
        [EmployeePanelController::class, 'leaves']
    );

    Route::get(
        '/my-payslip',
        [EmployeePanelController::class, 'payslip']
    );

    Route::get(
        '/punch',
        [EmployeePanelController::class, 'punchPage']
    );

    Route::post(
        '/punch-in',
        [EmployeePanelController::class, 'punchIn']
    );

    Route::post(
        '/punch-out',
        [EmployeePanelController::class, 'punchOut']
    );

    Route::get(
        '/apply-leave',
        [EmployeePanelController::class, 'applyLeave']
    );

    Route::post(
        '/apply-leave',
        [EmployeePanelController::class, 'storeLeave']
    );


});
// settings

Route::get(
    '/settings',
    [SettingController::class,'index']
);


Route::post(
    '/settings/update',
    [SettingController::class,'update']
);
/*
|--------------------------------------------------------------------------
/*
|--------------------------------------------------------------------------
| KPI ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth'
])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | KPI DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/kpi/dashboard',
        [KpiController::class,'dashboard']
    )->name('kpi.dashboard');



    /*
    |--------------------------------------------------------------------------
    | EMPLOYEE KPI
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/kpi-points',
        [KpiController::class,'index']
    )->name('kpi.index');



    /*
    |--------------------------------------------------------------------------
    | KPI EVALUATION
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/kpi/evaluate/{id}',
        [KpiController::class,'evaluate']
    )->name('kpi.evaluate');



    Route::post(
        '/kpi/store',
        [KpiController::class,'store']
    )->name('kpi.store');



    /*
    |--------------------------------------------------------------------------
    | KPI VIEW
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/kpi/show/{id}',
        [KpiController::class,'show']
    )->name('kpi.show');



    /*
    |--------------------------------------------------------------------------
    | KPI REPORTS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/kpi/reports',
        [KpiController::class,'reports']
    )->name('kpi.reports');

});