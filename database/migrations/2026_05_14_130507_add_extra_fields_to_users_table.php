<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('employee_id')
                  ->nullable();

            $table->string('salary')
                  ->nullable();

            $table->string('photo')
                  ->nullable();

            $table->date('joining_date')
                  ->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([

                'employee_id',

                'salary',

                'photo',

                'joining_date'

            ]);

        });
    }
};