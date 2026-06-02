<?php

namespace App\Services;


use App\Models\PayrollSetting;
use App\Models\Deduction;


class PayrollService
{

public function calculate($user,$basicSalary)
{

$totalDeduction = 0;


$setting =
PayrollSetting::first();


// PF

if(
$setting &&
$setting->pf_enabled
){

$pf =
($basicSalary *
$setting->pf_percentage)
/100;


$totalDeduction += $pf;

}


// ESI

if(
$setting &&
$setting->esi_enabled
){

$esi =
($basicSalary *
$setting->esi_percentage)
/100;


$totalDeduction += $esi;

}


// CUSTOM

$deductions =
Deduction::where(
'status',
1
)
->get();


foreach($deductions as $deduction){


if($deduction->type=='percentage'){

$totalDeduction +=
($basicSalary *
$deduction->value)
/100;

}else{


$totalDeduction +=
$deduction->value;

}

}



return [

'gross_salary'
    =>
$basicSalary,


'deductions'
    =>
$totalDeduction,


'net_salary'
    =>
$basicSalary-$totalDeduction

];


}

}