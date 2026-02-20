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
        Schema::create('driver_student', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto_increment

            $table->unsignedBigInteger('driver_id')->nullable()->index();
            $table->unsignedBigInteger('student_id')->nullable()->index();

            $table->enum('status', ['Active', 'Inactive'])
                ->default('Active');

            $table->text('notes')->nullable();

            $table->timestamps();

            // Optional: Foreign Keys (if needed)
            /*
            $table->foreign('driver_id')
                  ->references('id')->on('drivers')
                  ->nullOnDelete();

            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->nullOnDelete();
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_student');
    }
};
