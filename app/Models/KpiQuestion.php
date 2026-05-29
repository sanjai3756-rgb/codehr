<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiQuestion extends Model
{
    protected $fillable = [

        'category_id',
        'question',
        'description',
        'target'

    ];


    public function category()
    {
        return $this->belongsTo(
            KpiCategory::class,
            'category_id'
        );
    }
}