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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('verkoper_naam');
            $table->unsignedBigInteger('verkoper_id');
            $table->string('titel');
            $table->text('beschrijving');
            $table->string('soort')->default('');
            $table->double('prijs');
            $table->string('url')->nullable();
            $table->string('components')->nullable();
            $table->string('eenheid')->nullable();
            $table->timestamps();

            $table->foreign('verkoper_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
