<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model

{
    public function designations()
{
    return $this->hasMany(Designation::class);
}
    protected $fillable = [
    'department_name',
    'department_code',
    'status'
];
}

