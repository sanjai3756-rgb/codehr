<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiEvaluation extends Model
{
    public function employee()
{
    return $this->belongsTo(
        \App\Models\User::class,
        'employee_id'
    );
}
}
