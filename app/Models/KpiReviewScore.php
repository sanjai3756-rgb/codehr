<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiReviewScore extends Model
{
    protected $fillable = [

        'review_id',
        'question_id',
        'week1',
        'week2',
        'average'

    ];

    public function review()
    {
        return $this->belongsTo(
            KpiReview::class,
            'review_id'
        );
    }

public function question()
{
    return $this->belongsTo(
        KpiQuestion::class,
        'question_id'
    );
}
}