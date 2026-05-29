<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiReview extends Model
{
    protected $fillable = [

        'employee_id',
        'evaluator_id',
        'month',
        'year',
        'total_score'

    ];


    public function employee()
    {
        return $this->belongsTo(
            User::class,
            'employee_id'
        );
    }


    public function evaluator()
    {
        return $this->belongsTo(
            User::class,
            'evaluator_id'
        );
    }

public function scores()
{
    return $this->hasMany(
        KpiReviewScore::class,
        'review_id'
    );
}
}