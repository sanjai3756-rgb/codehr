<?php

namespace App\Http\Controllers;


use App\Models\Attendance;
use App\Models\Holiday;
use Carbon\Carbon;
use App\Models\AttendanceSetting;
use App\Models\Employee;

class AttendanceController extends Controller
{


public function adminAttendance()
{

    $attendances =
        Attendance::with(
            'employee'
        )
        ->latest()
        ->get();


    return view(
        'attendance.admin',
        compact('attendances')
    );

}





public function employeeAttendance()
{


    $attendances =
    Attendance::where(
        'employee_id',
        auth()->user()->employee->id
    )
        ->latest()
        ->get();


    return view(
        'attendance.employee',
        compact('attendances')
    );


}








public function checkIn()
{


    $already =
        Attendance::where(
            'employee_id',
            auth()->id()
        )
        ->whereDate(
            'date',
            today()
        )
        ->first();



    if($already){

        return back()
        ->with(
            'error',
            'Already Checked In Today'
        );

    }





    // OFFICE TIME

 $setting =
AttendanceSetting::first();


$officeTime =
Carbon::parse(
    $setting->office_start_time
);


    $now =
        Carbon::now();


    $late = null;



    if(
        $now->greaterThan(
            $officeTime
        )
    ){

        $late =
        $officeTime
        ->diff(
            $now
        )
        ->format('%H:%I:%S');

    }






    Attendance::create([


     'employee_id'
    =>
auth()->user()->employee->id,


        'date'
            =>
        today(),


        'check_in'
            =>
        now()
        ->format('H:i:s'),


        'late_by'
            =>
        $late,


        'status'
            =>
        'present'


    ]);





    return back()
    ->with(
        'success',
        'Checked In Successfully'
    );


}











public function checkOut()
{


   Attendance::where(
    'employee_id',
    auth()->user()->employee->id
        )
        ->whereDate(
            'date',
            today()
        )
        ->first();




    if(!$attendance){


        return back()
        ->with(
            'error',
            'Please Check In First'
        );

    }




    if(
        $attendance->check_out
    ){


        return back()
        ->with(
            'error',
            'Already Checked Out'
        );

    }





    $attendance->check_out =
        now()->format(
            'H:i:s'
        );





    $checkIn =
        Carbon::parse(
            $attendance->check_in
        );



    $checkOut =
        Carbon::parse(
            $attendance->check_out
        );




    $hours =
        round(

            $checkIn
            ->diffInMinutes(
                $checkOut
            )
            /60,

            2

        );



    $attendance->working_hours =
        $hours;





    // HALF DAY LOGIC


// GET ATTENDANCE SETTINGS

$setting =
    AttendanceSetting::first();



// HALF DAY LOGIC

if(
    $hours <
    $setting->half_day_hours
){

    $attendance->status =
        'half_day';

}
else{

    $attendance->status =
        'present';

}






    // SALARY CALCULATION

    $employee =
        auth()->user();


    $perDay =
        $employee->salary / 30;



    if(
        $attendance->status
        ==
        'present'
    ){

        $attendance->salary_amount =
            $perDay;

    }
    else{

        $attendance->salary_amount =
            $perDay / 2;

    }







    $attendance->save();





    return back()
    ->with(
        'success',
        'Checked Out Successfully'
    );



}



}