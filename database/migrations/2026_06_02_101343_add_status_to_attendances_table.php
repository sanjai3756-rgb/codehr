<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{


public function up(): void
{


Schema::table(
'attendances',
function(Blueprint $table){



if(
    !Schema::hasColumn(
        'attendances',
        'status'
    )
){

$table->enum(
'status',
[
'present',
'half_day',
'absent',
'holiday'
]
)
->default('present');

}




if(
    !Schema::hasColumn(
        'attendances',
        'late_by'
    )
){

$table->time(
'late_by'
)
->nullable();

}



});

}




public function down(): void
{


Schema::table(
'attendances',
function(Blueprint $table){


if(
Schema::hasColumn(
'attendances',
'late_by'
)
){

$table->dropColumn(
'late_by'
);

}


});


}



};