<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveSetting;

class LeaveSettingController extends Controller
{
    public function index()
    {
        $setting = LeaveSetting::first();

        if(!$setting)
        {
            $setting = LeaveSetting::create([]);
        }

        return view(
            'leave_settings.index',
            compact('setting')
        );
    }



    public function update(Request $request)
    {
        $setting = LeaveSetting::first();

        $setting->update([

            'auto_approve' =>
                $request->has('auto_approve'),

            'hr_can_approve' =>
                $request->has('hr_can_approve'),

            'manager_can_approve' =>
                $request->has('manager_can_approve')

        ]);


        return back()->with(
            'success',
            'Settings Updated'
        );
    }
}