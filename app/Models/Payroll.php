<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id',
        'month',
        'basic_salary',
        'allowance',
        'bonus',
        'deduction',
        'net_salary'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}