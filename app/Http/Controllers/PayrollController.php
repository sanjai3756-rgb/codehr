<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Payroll;
use App\Models\Attendance;
use App\Models\PayrollSetting;


class PayrollController extends Controller
{


public function index()
{

    $payrolls =
        Payroll::with(
            'employee'
        )
        ->latest()
        ->get();


    return view(
        'payrolls.index',
        compact(
            'payrolls'
        )
    );

}






public function generate(
    User $employee
)
{


    // Attendance salary total


    $gross =

    Attendance::where(
        'employee_id',
        $employee->id
    )
    ->sum(
        'salary_amount'
    );





    $setting =
        PayrollSetting::first();




    $pfAmount = 0;

    $esiAmount = 0;

    $deduction = 0;





    /*
    |--------------------------------------------------------------------------
    | PF CALCULATION
    |--------------------------------------------------------------------------
    |
    | <= 15000 : salary * percentage
    | > 15000  : 15000 * percentage
    |
    */



    if(
        $setting &&
        $setting->pf_enabled
    ){


        if(
            $gross <= 15000
        ){

            $pfAmount =

            (
                $gross *
                $setting->pf_percentage
            )
            /
            100;


        }else{


            $pfAmount =

            (
                15000 *
                $setting->pf_percentage
            )
            /
            100;


        }



        $deduction +=
            $pfAmount;

    }







    /*
    |--------------------------------------------------------------------------
    | ESI CALCULATION
    |--------------------------------------------------------------------------
    |
    | <= 21000 only ESI
    | > 21000 no ESI
    |
    */




    if(
        $setting &&
        $setting->esi_enabled
    ){



        if(
            $gross <= 21000
        ){


            $esiAmount =

            (
                $gross *
                $setting->esi_percentage
            )
            /
            100;



            $deduction +=
                $esiAmount;


        }


    }







    $netSalary =
        $gross -
        $deduction;







    Payroll::create([



        'employee_id'
            =>
        $employee->id,



        'gross_salary'
            =>
        $gross,



        'pf_amount'
            =>
        $pfAmount,



        'esi_amount'
            =>
        $esiAmount,



        'total_deduction'
            =>
        $deduction,



        'net_salary'
            =>
        $netSalary



    ]);






    return back()
    ->with(
        'success',
        'Payroll Generated Successfully'
    );

}



}