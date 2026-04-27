<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('leave_requests', function (Blueprint $table) {
        $table->foreignId('employee_id')->nullable()->after('id');
        $table->string('leave_type');
        $table->date('from_date');
        $table->date('to_date');
        $table->text('reason')->nullable();
        $table->enum('status',['Pending','Approved','Rejected'])->default('Pending');
    });
}
};
