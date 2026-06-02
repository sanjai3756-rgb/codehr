<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

public function up(): void
{

Schema::create(
'attendance_settings',
function(Blueprint $table){


$table->id();


$table->time(
'office_start_time'
)
->default(
'09:30:00'
);



$table->decimal(
'full_day_hours',
5,
2
)
->default(8);



$table->decimal(
'half_day_hours',
5,
2
)
->default(4);



$table->timestamps();


});

}


public function down(): void
{

Schema::dropIfExists(
'attendance_settings'
);

}


};