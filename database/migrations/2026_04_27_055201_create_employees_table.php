<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('employees', function (Blueprint $table) {
        $table->id();

        $table->string('employee_id')->unique();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone')->nullable();

        $table->foreignId('department_id')->constrained()->onDelete('cascade');
        $table->foreignId('designation_id')->constrained()->onDelete('cascade');

        $table->date('joining_date')->nullable();
        $table->decimal('salary',10,2)->default(0);

        $table->string('photo')->nullable();

        $table->text('address')->nullable();

        $table->boolean('status')->default(1);

        $table->timestamps();
    });
}
};