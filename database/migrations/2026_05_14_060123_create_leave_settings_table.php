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
        Schema::create('leave_settings', function (Blueprint $table) {

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | AUTO APPROVAL
            |--------------------------------------------------------------------------
            */

            $table->boolean('auto_approve')
                  ->default(false);


            /*
            |--------------------------------------------------------------------------
            | HR APPROVAL ACCESS
            |--------------------------------------------------------------------------
            */

            $table->boolean('hr_can_approve')
                  ->default(true);


            /*
            |--------------------------------------------------------------------------
            | MANAGER APPROVAL ACCESS
            |--------------------------------------------------------------------------
            */

            $table->boolean('manager_can_approve')
                  ->default(false);


            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_settings');
    }
};