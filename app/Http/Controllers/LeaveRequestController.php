<?php

namespace App\Http\Controllers;


use App\Models\LeaveRequest;
use App\Models\Employee;
use App\Models\LeaveSetting;
use App\Models\LeaveBalance;

use Illuminate\Http\Request;


class LeaveRequestController extends Controller
{


public function index()
{

    $leaves =
        LeaveRequest::with(
            'employee'
        )
        ->latest()
        ->get();


    return view(
        'leaves.index',
        compact('leaves')
    );

}




public function create()
{

    $employees =
        Employee::all();


    return view(
        'leaves.create',
        compact('employees')
    );

}




public function store(Request $request)
{

    LeaveRequest::create(
        $request->all()
    );


    return redirect()
        ->route('leaves.index')
        ->with(
            'success',
            'Leave Applied'
        );

}






public function approve($id)
{


    $leave =
        LeaveRequest::findOrFail(
            $id
        );



    $setting =
        LeaveSetting::first();




    /*
    |--------------------------------------------------------------------------
    | GET EMPLOYEE LEAVE BALANCE
    |--------------------------------------------------------------------------
    */


    $balance =
        LeaveBalance::firstOrCreate(

            [

                'employee_id'
                    =>
                $leave->employee_id,


                'year'
                    =>
                now()->year,


                'month'
                    =>
                now()->month

            ],



            [

                'balance'
                    =>
                $setting->paid_leave_limit

            ]

        );






    /*
    |--------------------------------------------------------------------------
    | PAID OR LOP
    |--------------------------------------------------------------------------
    */


    if(

        $balance->balance
        >=
        $leave->total_days

    ){



        // FULL PAID


        $leave->salary_status =
            'paid';



        $balance->balance =
            $balance->balance -
            $leave->total_days;



    }else{



        // NO BALANCE


        $leave->salary_status =
            'lop';



    }






    $leave->status =
        'approved';




    $balance->save();


    $leave->save();






    return back()
        ->with(
            'success',
            'Leave Approved Successfully'
        );


}







public function edit(
    LeaveRequest $leave
)
{

    return view(
        'leaves.edit',
        compact('leave')
    );

}






public function update(
    Request $request,
    LeaveRequest $leave
)
{

    $leave->update(
        $request->all()
    );


    return redirect()
        ->route(
            'leaves.index'
        )
        ->with(
            'success',
            'Updated'
        );

}


}