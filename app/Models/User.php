<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
public function designation()
{
    return $this->belongsTo(
        \App\Models\Designation::class
    );
}

use HasFactory, Notifiable, HasRoles;

protected $fillable = [

    'name',

    'email',

    'phone',

    'password',

    'designation_id',

    'employee_id',

    'salary',

    'photo',

    'joining_date'

];
    protected $hidden = [
        'password',
        'remember_token',

        ];
 
}

