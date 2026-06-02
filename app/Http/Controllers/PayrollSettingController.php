<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\PayrollSetting;


class PayrollSettingController extends Controller
{


public function index()
{

    $setting =
        PayrollSetting::first();


    if(!$setting){

        $setting =
        PayrollSetting::create([

            'pf_enabled' => true,

            'pf_percentage' => 12,


            'esi_enabled' => true,

            'esi_percentage' => 0.75

        ]);

    }


    return view(
        'payrolls.settings',
        compact('setting')
    );

}





public function update(Request $request)
{


    $setting =
        PayrollSetting::first();


    if(!$setting){

        $setting =
        new PayrollSetting();

    }



    $setting->pf_enabled =
        $request->has(
            'pf_enabled'
        );


    $setting->pf_percentage =
        $request->pf_percentage;



    $setting->esi_enabled =
        $request->has(
            'esi_enabled'
        );


    $setting->esi_percentage =
        $request->esi_percentage;



    $setting->save();




    return back()
        ->with(
            'success',
            'Payroll Settings Updated'
        );


}



}