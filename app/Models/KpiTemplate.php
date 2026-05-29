<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiTemplate extends Model
{
    protected $fillable = [

        'role'

    ];


    public function categories()
    {
        return $this->hasMany(
            KpiCategory::class,
            'template_id'
        );
    }
}