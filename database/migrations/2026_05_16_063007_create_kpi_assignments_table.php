<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kpi_assignments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('evaluator_id');

            $table->foreignId('employee_id');

            $table->string('month');

            $table->string('year');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpi_assignments');
    }
};