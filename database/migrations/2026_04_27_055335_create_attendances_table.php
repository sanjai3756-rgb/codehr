<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {

            $table->id();

            $table->foreignId('employee_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->date('date');

            $table->time('check_in')
                  ->nullable();

            $table->time('check_out')
                  ->nullable();

            $table->decimal(
                'working_hours',
                5,
                2
            )->default(0);

            $table->decimal(
                'salary_amount',
                10,
                2
            )->default(0);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'attendances'
        );
    }
};