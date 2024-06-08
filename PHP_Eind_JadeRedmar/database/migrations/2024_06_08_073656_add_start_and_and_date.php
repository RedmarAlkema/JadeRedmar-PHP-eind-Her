<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->string('type'); // Add a string column for the type
            $table->timestamp('start_time')->nullable(); // Add a timestamp column for the start time, allow null values
            $table->timestamp('end_time')->nullable(); // Add a timestamp column for the end time, allow null values
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->dropColumn('type'); // Remove the type column
            $table->dropColumn('start_time'); // Remove the start_time column
            $table->dropColumn('end_time'); // Remove the end_time column
        });
    }
};
