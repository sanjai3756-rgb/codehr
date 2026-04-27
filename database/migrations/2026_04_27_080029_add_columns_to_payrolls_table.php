<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payrolls', function (Blueprint $table) {
            $table->foreignId('employee_id')->nullable()->after('id');
            $table->string('month')->nullable();
            $table->decimal('basic_salary',10,2)->default(0);
            $table->decimal('allowance',10,2)->default(0);
            $table->decimal('bonus',10,2)->default(0);
            $table->decimal('deduction',10,2)->default(0);
            $table->decimal('net_salary',10,2)->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('payrolls', function (Blueprint $table) {
            $table->dropColumn([
                'employee_id',
                'month',
                'basic_salary',
                'allowance',
                'bonus',
                'deduction',
                'net_salary'
            ]);
        });
    }
};