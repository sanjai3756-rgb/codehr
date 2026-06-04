<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ShiftController extends Controller
{
   public function index()
{
    $shifts = Shift::with('users')->get();

    return view(
        'shifts.index',
        compact('shifts')
    );
}

    public function create()
    {
        return view('shifts.create');
    }


public function store(Request $request)
{


    $start =
        $request->start_hour
        .':'
        .$request->start_minute
        .' '
        .$request->start_ampm;



    $end =
        $request->end_hour
        .':'
        .$request->end_minute
        .' '
        .$request->end_ampm;





    Shift::create([


        'name'=>$request->name,



        'start_time'=>date(
            'H:i:s',
            strtotime($start)
        ),




        'end_time'=>date(
            'H:i:s',
            strtotime($end)
        ),




        'late_minutes'=>$request->late_minutes,



        'status'=>1


    ]);






    return redirect()
        ->route('shifts.index')
        ->with(
            'success',
            'Shift Created Successfully'
        );

}


  public function edit(Shift $shift)
    {
        return view(
            'shifts.edit',
            compact('shift')
        );
    }


 public function update(Request $request, Shift $shift)
{
    $shift->update([

        'name' => $request->name,

        'start_time' => $request->start_time,

        'end_time' => $request->end_time,

        'late_minutes' => $request->late_minutes,

        'status' => $request->status ?? 1,

    ]);


    return redirect()
        ->route('shifts.index')
        ->with(
            'success',
            'Shift Updated Successfully'
        );
}

public function destroy(Shift $shift)
{
    $shift->delete();

    return redirect()
    ->route('shifts.index')
    ->with(
        'success',
        'Shift Deleted'
    );
}

}