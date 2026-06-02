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
use App\Http\Controllers\KpiAssignmentController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\LeaveSettingController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PayrollSettingController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\EmployeePanelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AttendanceSettingController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => redirect('/login'));

Route::get('/login', [AuthController::class, 'loginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post(
    '/logout',
    [AuthController::class,'logout']
)
->name('logout');


/*
|--------------------------------------------------------------------------
| COMMON
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    if (auth()->user()->hasRole('admin')) {
        return redirect('/admin/dashboard');
    }

    if (auth()->user()->hasRole('hr')) {
        return redirect('/hr/dashboard');
    }

    return redirect('/employee/dashboard');

})->middleware('auth');    




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

Route::get(
    '/attendances',
    [AttendanceController::class,'adminAttendance']
);

Route::get(
    '/attendance/admin',
    [AttendanceController::class,
    'adminAttendance']
)->name('attendance.admin');

Route::get(
    '/attendance/my',
    [AttendanceController::class,
    'employeeAttendance']
)->name('attendance.employee');

Route::post(
    '/attendance/check-in',
    [AttendanceController::class,'checkIn']
)->name('attendances.checkin');

Route::post(
    '/attendance/check-out',
    [AttendanceController::class,'checkOut']
)->name('attendances.checkout');

Route::get(
'/attendance-settings',
[AttendanceSettingController::class,'index']
)
->name('attendance.settings');


Route::post(
'/attendance-settings',
[AttendanceSettingController::class,'update']
)
->name('attendance.settings.update');


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


    // Generate employee payroll

    Route::get(
        '/payroll/generate/{employee}',
        [PayrollController::class,'generate']
    )
    ->name('payroll.generate');



    // PF ESI Settings

    Route::get(
        '/payroll-settings',
        [PayrollSettingController::class,'index']
    )
    ->name('payroll.settings');


    Route::post(
        '/payroll-settings',
        [PayrollSettingController::class,'update']
    )
    ->name('payroll.settings.update');


});

/*
|--------------------------------------------------------------------------
| HOLIDAYS
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth'
])->group(function(){

    Route::resource(
        'holidays',
        HolidayController::class
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
)
->name('leave.settings');


Route::post(
    '/leave-settings',
    [LeaveSettingController::class,'update']
)
->name('leave.settings.update');

Route::get(
    '/leave-settings',
    [LeaveSettingController::class,'index']
)
->name('leave.settings');



Route::post(
    '/leave-settings',
    [LeaveSettingController::class,'update']
)
->name('leave.settings.update');

});


// APPROVAL SETTINGS

Route::get(
    '/leave-approval-settings',
    [LeaveSettingController::class,'approval']
)
->name('leave.approval');


Route::post(
    '/leave-approval-settings',
    [LeaveSettingController::class,'approvalUpdate']
)
->name('leave.approval.update');
Route::post(
    '/leaves/{id}/approve',
    [LeaveRequestController::class,'approve']
)
->name('leaves.approve');




// LEAVE LIMIT SETTINGS

Route::get(
    '/leave-settings',
    [LeaveSettingController::class,'index']
)
->name('leave.settings');


Route::post(
    '/leave-settings',
    [LeaveSettingController::class,'update']
)
->name('leave.settings.update');



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



    // KPI Assignment permission

    Route::get(

    '/kpi/assignments',

    [KpiAssignmentController::class,'index']

)->name('kpi.assignments');



Route::post(

    '/kpi/assignments/store',

    [KpiAssignmentController::class,'store']

)->name('kpi.assignments.store');


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

Route::post(
    '/kpi/submit',
    [KpiController::class,'submitEvaluation']
)->name('kpi.submit');

Route::get(
    '/kpi/report/edit/{id}',
    [KpiController::class,'editReport']
)->name('kpi.report.edit');

Route::post(
    '/kpi/report/update/{id}',
    [KpiController::class,'updateReport']
)->name('kpi.report.update');

Route::delete(
    '/kpi/report/delete/{id}',
    [KpiController::class,'deleteReport']
)->name('kpi.report.delete');

// kpi pdf download
Route::get(
    '/kpi/report/pdf/{id}',
    [KpiController::class,'downloadPdf']
)->name('kpi.pdf');

Route::post(
    '/kpi/report/bulk-pdf',
    [KpiController::class,'bulkPdf']
)->name('kpi.bulk.pdf');

Route::post(
    '/kpi/bulk-pdf',
    [KpiController::class,'bulkPdf']
)->name('kpi.bulk.pdf');

});