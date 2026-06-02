<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

public function up(): void
{

    Schema::table(
        'payrolls',
        function (Blueprint $table) {


            if (!Schema::hasColumn(
                'payrolls',
                'gross_salary'
            )) {

                $table->decimal(
                    'gross_salary',
                    10,
                    2
                )
                ->default(0);

            }



            if (!Schema::hasColumn(
                'payrolls',
                'pf_amount'
            )) {

                $table->decimal(
                    'pf_amount',
                    10,
                    2
                )
                ->default(0);

            }



            if (!Schema::hasColumn(
                'payrolls',
                'esi_amount'
            )) {

                $table->decimal(
                    'esi_amount',
                    10,
                    2
                )
                ->default(0);

            }



            if (!Schema::hasColumn(
                'payrolls',
                'total_deduction'
            )) {

                $table->decimal(
                    'total_deduction',
                    10,
                    2
                )
                ->default(0);

            }



            if (!Schema::hasColumn(
                'payrolls',
                'net_salary'
            )) {

                $table->decimal(
                    'net_salary',
                    10,
                    2
                )
                ->default(0);

            }


        }
    );

}




public function down(): void
{

    Schema::table(
        'payrolls',
        function (Blueprint $table) {


            $columns = [

                'gross_salary',

                'pf_amount',

                'esi_amount',

                'total_deduction'

            ];


            foreach(
                $columns as $column
            ){

                if(
                    Schema::hasColumn(
                        'payrolls',
                        $column
                    )
                ){

                    $table->dropColumn(
                        $column
                    );

                }

            }


        }
    );

}

};