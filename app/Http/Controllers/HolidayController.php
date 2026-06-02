<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;


class HolidayController extends Controller
{

public function index()
{
    $holidays =
        Holiday::latest()
        ->get();


    return view(
        'holidays.index',
        compact('holidays')
    );
}



public function store(Request $request)
{

    $request->validate([

        'title'=>'required',

        'date'=>'required',

        'type'=>'required'

    ]);


    Holiday::create([

        'title'=>$request->title,

        'date'=>$request->date,

        'type'=>$request->type

    ]);


    return back()
    ->with(
        'success',
        'Holiday Added'
    );

}



public function destroy($id)
{

    Holiday::findOrFail($id)
        ->delete();


    return back()
    ->with(
        'success',
        'Holiday Deleted'
    );

}

}