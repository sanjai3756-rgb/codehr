<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class LeaveBalance extends Model
{

protected $fillable = [

'employee_id',

'year',

'month',

'balance'

];

}