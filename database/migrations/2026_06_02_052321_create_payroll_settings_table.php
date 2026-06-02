<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

public function up(): void
{

    Schema::create(
        'payroll_settings',
        function (Blueprint $table) {


            $table->id();


            // PF SETTINGS

            $table->boolean(
                'pf_enabled'
            )
            ->default(true);



            $table->decimal(
                'pf_percentage',
                5,
                2
            )
            ->default(12);



            // ESI SETTINGS


            $table->boolean(
                'esi_enabled'
            )
            ->default(true);



            $table->decimal(
                'esi_percentage',
                5,
                2
            )
            ->default(0.75);



            $table->timestamps();

        }
    );

}




public function down(): void
{

    Schema::dropIfExists(
        'payroll_settings'
    );

}


};