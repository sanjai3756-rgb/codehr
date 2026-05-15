<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveSetting extends Model
{
    protected $fillable = [

        'auto_approve',

        'hr_can_approve',

        'manager_can_approve'

    ];
}