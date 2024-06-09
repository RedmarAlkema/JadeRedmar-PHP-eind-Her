<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWearAndTearToAdvertisementsTable extends Migration
{
    public function up()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->decimal('wear_and_tear', 8, 2)->nullable()->after('prijs');
        });
    }

    public function down()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->dropColumn('wear_and_tear');
        });
    }
}
