<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = [

    'user_id',

    'employee_id',

    'name',

    'email',

    'phone',

    'designation_id',

    'salary',

    'joining_date'

];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
    
}