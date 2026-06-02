<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

public function up(): void
{

Schema::create(
    'leaves',
    function (Blueprint $table) {


        $table->id();


        $table->foreignId(
            'employee_id'
        )
        ->constrained(
            'users'
        )
        ->cascadeOnDelete();



        $table->date(
            'from_date'
        );


        $table->date(
            'to_date'
        );


        $table->integer(
            'total_days'
        );


        $table->text(
            'reason'
        )
        ->nullable();



        $table->enum(
            'status',
            [
                'pending',
                'approved',
                'rejected'
            ]
        )
        ->default(
            'pending'
        );



        // paid or LOP

        $table->enum(
            'salary_status',
            [
                'paid',
                'lop'
            ]
        )
        ->nullable();



        $table->timestamps();

    }
);

}



public function down(): void
{

    Schema::dropIfExists(
        'leaves'
    );

}


};