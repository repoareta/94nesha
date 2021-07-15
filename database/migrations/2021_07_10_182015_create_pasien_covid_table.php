<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienCovidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien_covid', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jurusan', 64);
            $table->string('nama_kontak')->nullable();
            $table->string('no_kontak', 20)->nullable();
            $table->string('jenkel', 1);
            $table->string('goldar', 1)->nullable();
            $table->date('tgl_negatif');
            $table->char('province_id', 2);
            $table->foreign('province_id')->on('provinces')->references('id')->onDelete('cascade');
            $table->char('regency_id', 4);
            $table->foreign('regency_id')->on('regencies')->references('id')->onDelete('cascade');
            $table->char('district_id', 7)->nullable();
            $table->foreign('district_id')->on('districts')->references('id')->onDelete('cascade');
            $table->char('village_id', 10)->nullable();
            $table->foreign('village_id')->on('villages')->references('id')->onDelete('cascade');
            $table->text('kondisi')->nullable();
            $table->boolean('status')->nullable()->comment('0: Isoman, 1: Rumah sakit');
            $table->text('ket_status')->nullable();
            $table->text('kebutuhan')->nullable();
            $table->text('meninggal_dunia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasien_covid');
    }
}
