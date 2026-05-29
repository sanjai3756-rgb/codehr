<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kpi_review_scores', function (Blueprint $table) {

            $table->id();

            $table->foreignId('review_id');

            $table->foreignId('question_id');

            $table->double('week1')->default(0);

            $table->double('week2')->default(0);

            $table->double('average')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpi_review_scores');
    }
};