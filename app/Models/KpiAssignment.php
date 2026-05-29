<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiAssignment extends Model
{
    protected $fillable = [

        'evaluator_id',
        'employee_id',
        'month',
        'year'

    ];


    public function evaluator()
    {
        return $this->belongsTo(
            User::class,
            'evaluator_id'
        );
    }


    public function employee()
    {
        return $this->belongsTo(
            User::class,
            'employee_id'
        );
    }
}