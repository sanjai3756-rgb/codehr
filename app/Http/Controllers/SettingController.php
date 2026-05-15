<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        if(!$setting)
        {
            $setting = Setting::create([

                'website_name' => 'CodeHR'

            ]);
        }

        return view(
            'settings.index',
            compact('setting')
        );
    }



public function update(Request $request)
{
    $setting = \App\Models\Setting::first();


    if(!$setting)
    {
        $setting = new \App\Models\Setting();
    }


    $setting->website_name =
        $request->website_name;

    $setting->theme_color =
        $request->theme_color;

    $setting->font_family =
        $request->font_family;


    /*
    |--------------------------------------------------------------------------
    | LOGO
    |--------------------------------------------------------------------------
    */

    if($request->hasFile('logo'))
    {
        $file = $request->file('logo');

        $name = time().'.'.$file
                              ->getClientOriginalExtension();

        $file->move(
            public_path('uploads/settings'),
            $name
        );

        $setting->logo = $name;
    }


    $setting->save();


    return back()->with(
        'success',
        'Settings Updated Successfully'
    );
}
}