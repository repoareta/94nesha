<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToPositifInPenyintasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penyintas_covid', function (Blueprint $table) {
            $table->dropColumn('tgl_positif');
            $table->date('tgl_negatif')->nullable();
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
            $table->dropColumn('tgl_negatif');
            $table->date('tgl_positif')->nullable();
        });
    }
}
