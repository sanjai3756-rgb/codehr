<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Shift;

// SPATIE ROLE PERMISSION
use Spatie\Permission\Traits\HasRoles;

// MODELS
use App\Models\Department;
use App\Models\Designation;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id',
        'designation_id',
        'salary_type',
        'hourly_rate',
        'daily_rate',
        'shift_id',
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * User belongs to department
     */
    public function department()
    {
        return $this->belongsTo(
            Department::class,
            'department_id'
        );
    }

    /**
     * User belongs to designation
     */
public function designation()
{
    return $this->belongsTo(
        \App\Models\Designation::class,
        'designation_id'
    );
}

public function employee()
{
     return $this->hasOne(Employee::class);
}


public function shift()
{
    return $this->belongsTo(
        Shift::class,
        'shift_id'
    );
}

}