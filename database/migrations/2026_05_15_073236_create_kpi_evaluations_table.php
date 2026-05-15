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
    {Schema::create('kpi_evaluations', function (Blueprint $table)
{
    $table->id();

    $table->foreignId('employee_id');

    $table->foreignId('evaluator_id');

    $table->integer('month');

    $table->integer('year');

    $table->enum(
        'period',
        ['1-15','16-end']
    );

    $table->decimal(
        'total_score',
        5,
        2
    )->default(0);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi_evaluations');
    }
};
