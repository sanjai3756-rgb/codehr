<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {

     $table->enum(
    'salary_type',
    ['hourly','daily']
)->default('daily');

$table->decimal(
    'hourly_rate',
    10,
    2
)->nullable();

$table->decimal(
    'daily_rate',
    10,
    2
)->nullable();
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {

        $table->dropColumn([
            'salary_type',
            'hourly_rate',
            'daily_rate'
        ]);

    });
}
};