<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('driver_student', function (Blueprint $table) {
            $table->date('assignment_date')->nullable()->after('student_id');
            $table->unique(['student_id', 'assignment_date'], 'driver_student_student_date_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('driver_student', function (Blueprint $table) {
            $table->dropUnique('driver_student_student_date_unique');
            $table->dropColumn('assignment_date');
        });
    }
};
