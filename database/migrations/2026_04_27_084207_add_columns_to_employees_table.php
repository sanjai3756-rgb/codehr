<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('employee_id')->nullable()->after('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->date('joining_date')->nullable();
            $table->decimal('salary',10,2)->default(0);
            $table->string('photo')->nullable();
            $table->text('address')->nullable();
            $table->boolean('status')->default(1);
        });
    }

    public function down(): void {}
};