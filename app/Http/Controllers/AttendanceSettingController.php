<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\AttendanceSetting;


class AttendanceSettingController extends Controller
{


public function index()
{

    $setting =
    AttendanceSetting::first();



    if(!$setting){

        $setting =
        AttendanceSetting::create([

            'office_start_time'
                =>
            '09:30:00',

            'full_day_hours'
                =>
            8,


            'half_day_hours'
                =>
            4

        ]);

    }



    return view(
        'attendance.settings',
        compact('setting')
    );


}





public function update(Request $request)
{

    $setting =
        AttendanceSetting::first();



    $setting->update([


        'office_start_time'
            =>
        $request->office_start_time,


        'full_day_hours'
            =>
        $request->full_day_hours,


        'half_day_hours'
            =>
        $request->half_day_hours


    ]);




    return back()
    ->with(
        'success',
        'Attendance Settings Updated'
    );


}



}