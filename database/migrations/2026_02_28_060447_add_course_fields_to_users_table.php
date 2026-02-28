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
        Schema::table('users', function (Blueprint $table) {

            $table->integer('course_id')
                ->nullable()
                ->after('remarks');

            $table->string('course_name')
                ->nullable()
                ->after('course_id');

            $table->decimal('regular_course_fee', 10, 2)
                ->nullable()
                ->after('course_name');

            $table->decimal('actual_course_fee', 10, 2)
                ->nullable()
                ->after('regular_course_fee');

            $table->integer('total_class')
                ->nullable()
                ->after('actual_course_fee');

            $table->integer('per_class_duration')
                ->nullable()
                ->comment('Duration per class in minutes')
                ->after('total_class');

            $table->integer('total_duration')
                ->nullable()
                ->comment('Total course duration in minutes')
                ->after('per_class_duration');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'course_name',
                'regular_course_fee',
                'actual_course_fee',
                'total_class',
                'per_class_duration',
                'total_duration',
            ]);
        });
    }
};
