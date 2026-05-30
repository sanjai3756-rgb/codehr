<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function adminAttendance()
    {
        $attendances = Attendance::with(
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
    $attendances = Attendance::where(
        'employee_id',
        auth()->id()
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
    Attendance::create([

        'employee_id' => auth()->id(),

        'date' => now()->toDateString(),

        'check_in' => now()->format('H:i:s')

    ]);

    return back()->with(
        'success',
        'Checked In Successfully'
    );
}
public function checkOut()
{
    $attendance = Attendance::where(
        'employee_id',
        auth()->id()
    )
    ->whereDate(
        'date',
        today()
    )
    ->first();

    if (!$attendance) {

        return back()->with(
            'error',
            'Please Check In First'
        );
    }

    if ($attendance->check_out) {

        return back()->with(
            'error',
            'Already Checked Out'
        );
    }

    $attendance->check_out =
        now()->format('H:i:s');

    $checkIn = Carbon::parse(
        $attendance->check_in
    );

    $checkOut = Carbon::parse(
        $attendance->check_out
    );

    $attendance->working_hours =
        round(
            $checkIn->diffInMinutes(
                $checkOut
            ) / 60,
            2
        );

    $attendance->save();

    return back()->with(
        'success',
        'Checked Out Successfully'
    );
}}