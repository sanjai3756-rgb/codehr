<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Payroll extends Model
{


protected $fillable = [

    'employee_id',

    'gross_salary',

    'pf_amount',

    'esi_amount',

    'total_deduction',

    'net_salary'

];



public function employee()
{

    return $this->belongsTo(
        User::class,
        'employee_id'
    );

}


}