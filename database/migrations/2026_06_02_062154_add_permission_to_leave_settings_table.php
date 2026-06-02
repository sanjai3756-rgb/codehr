<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

public function up(): void
{

    Schema::table(
        'leave_settings',
        function (Blueprint $table) {


            // monthly paid leave days

            if(
                !Schema::hasColumn(
                    'leave_settings',
                    'paid_leave_limit'
                )
            ){

                $table->integer(
                    'paid_leave_limit'
                )
                ->default(1);

            }



            // monthly paid permission hours

            if(
                !Schema::hasColumn(
                    'leave_settings',
                    'paid_permission_hours'
                )
            ){

                $table->decimal(
                    'paid_permission_hours',
                    5,
                    2
                )
                ->default(2);

            }


        }
    );

}




public function down(): void
{

    Schema::table(
        'leave_settings',
        function(Blueprint $table){


            $table->dropColumn([

                'paid_leave_limit',

                'paid_permission_hours'

            ]);


        }
    );

}

};