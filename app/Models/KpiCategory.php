<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiCategory extends Model
{
    protected $fillable = [

        'template_id',
        'category',
        'weightage'

    ];


    public function template()
    {
        return $this->belongsTo(
            KpiTemplate::class,
            'template_id'
        );
    }


    public function questions()
    {
        return $this->hasMany(
            KpiQuestion::class,
            'category_id'
        );
    }
}