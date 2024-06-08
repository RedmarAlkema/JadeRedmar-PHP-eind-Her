<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('background_color')->nullable();
            $table->text('intro_text')->nullable();
            $table->text('company_description')->nullable();
            $table->string('custom_url')->nullable();
            $table->string('profile_url')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('background_color');
            $table->dropColumn('intro_text');
            $table->dropColumn('company_description');
            $table->dropColumn('custom_url');
            $table->dropColumn('profile_url');
        });
    }
};
