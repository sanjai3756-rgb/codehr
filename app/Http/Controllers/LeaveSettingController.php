<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\LeaveSetting;
use App\Models\LeaveBalance;


class LeaveSettingController extends Controller
{


public function index()
{

    $setting =
        LeaveSetting::first();


    if(!$setting){


        $setting =
        LeaveSetting::create([

            'auto_approve' => 0,

            'hr_can_approve' => 0,

            'manager_can_approve' => 1,

            'paid_leave_limit' => 1,

            'paid_permission_hours' => 2

        ]);

    }



    return view(
        'leaves.settings',
        compact('setting')
    );

}




public function update(Request $request)
{


    $setting =
        LeaveSetting::first();


    if(!$setting){

        $setting =
            new LeaveSetting();

    }
}



public function approval()
{

    $setting =
        LeaveSetting::first();


    return view(
        'leaves.approval',
        compact('setting')
    );

}






public function approvalUpdate(Request $request)
{


    $setting =
        LeaveSetting::first();


    $setting->auto_approve =
        $request->has('auto_approve');


    $setting->hr_can_approve =
        $request->has('hr_can_approve');


    $setting->manager_can_approve =
        $request->has('manager_can_approve');


    $setting->save();



    return back()
    ->with(
        'success',
        'Approval Settings Updated'
    );




    // leave limits

    $setting->paid_leave_limit =
        $request->paid_leave_limit;



    $setting->paid_permission_hours =
        $request->paid_permission_hours;




    $setting->save();




    return redirect()
    ->route(
        'leave.settings'
    )
    ->with(
        'success',
        'Leave Settings Updated Successfully'
    );


}
}


