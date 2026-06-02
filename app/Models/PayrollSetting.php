<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollSetting extends Model
{
    protected $fillable = [

        'pf_enabled',

        'pf_percentage',


        'esi_enabled',

        'esi_percentage'

    ];
}