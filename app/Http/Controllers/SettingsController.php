<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view('settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        if(!$setting){
            $setting = new Setting();
        }

        $setting->company_name = $request->company_name;
        $setting->company_email = $request->company_email;
        $setting->phone = $request->phone;
        $setting->currency = $request->currency;
        $setting->timezone = $request->timezone;
        $setting->theme_color = $request->theme_color;

        if($request->hasFile('logo'))
        {
            $file = $request->file('logo');
            $name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/logo'), $name);

            $setting->logo = $name;
        }

        $setting->save();

        return back()->with('success','Settings Updated');
    }
}