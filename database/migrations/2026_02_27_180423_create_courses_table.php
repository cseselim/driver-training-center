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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->string('course_name');

            // Fees
            $table->decimal('regular_course_fee', 10, 2)->default(0);
            $table->decimal('actual_course_fee', 10, 2)->default(0);

            // Image path
            $table->string('image')->nullable();

            // Remarks / Notes
            $table->text('remark')->nullable();

            // Class details
            $table->integer('total_class')->default(0);

            // Duration per class (in minutes)
            $table->integer('per_class_duration')->comment('Duration per class in minutes');

            // Total duration (in minutes)
            $table->integer('total_duration')->comment('Total course duration in minutes');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
