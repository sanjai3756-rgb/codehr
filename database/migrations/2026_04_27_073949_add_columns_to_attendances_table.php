<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('employee_id')->nullable()->after('id');
            $table->date('date')->nullable();
            $table->enum('status', ['Present','Absent','Leave'])->default('Present');
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn([
                'employee_id',
                'date',
                'status',
                'check_in',
                'check_out'
            ]);
        });
    }
};