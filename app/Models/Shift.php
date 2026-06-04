<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Shift extends Model
{
    protected $fillable = [

        'name',
        'start_time',
        'end_time',
        'late_minutes',
        'status'

    ];




public function users()
{
    return $this->hasMany(
        User::class,
        'shift_id'
    );
}
}