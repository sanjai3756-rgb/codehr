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
        $setting = Setting::first();


        $data = [

            'website_name' =>
                $request->website_name,

            'theme_color' =>
                $request->theme_color

        ];


        if($request->hasFile('logo'))
        {
            $file = $request->file('logo');

            $name = time().'.'.$file
                                  ->getClientOriginalExtension();

            $file->move(
                public_path('uploads/settings'),
                $name
            );

            $data['logo'] = $name;
        }


        $setting->update($data);


        return back()->with(
            'success',
            'Settings Updated Successfully'
        );
    }
}