<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToNegatifInPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pasien_covid', function (Blueprint $table) {
            $table->dropColumn('tgl_negatif');
            $table->date('tgl_positif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pasien_covid', function (Blueprint $table) {
            $table->dropColumn('tgl_positif');
            $table->date('tgl_negatif')->nullable();
        });
    }
}
