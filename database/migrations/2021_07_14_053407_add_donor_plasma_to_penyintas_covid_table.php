<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDonorPlasmaToPenyintasCovidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penyintas_covid', function (Blueprint $table) {
            $table->boolean('donor_plasma')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penyintas_covid', function (Blueprint $table) {
            $table->dropColumn('donor_plasma');
        });
    }
}
