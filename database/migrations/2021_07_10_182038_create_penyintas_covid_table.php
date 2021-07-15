<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyintasCovidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyintas_covid', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jurusan', 64);
            $table->string('nama_kontak')->nullable();
            $table->string('no_kontak', 20)->nullable();
            $table->string('jenkel', 1);
            $table->string('goldar', 1)->nullable();
            $table->date('tgl_positif');
            $table->char('province_id', 2);
            $table->foreign('province_id')->on('provinces')->references('id')->onDelete('cascade');
            $table->char('regency_id', 4);
            $table->foreign('regency_id')->on('regencies')->references('id')->onDelete('cascade');
            $table->char('district_id', 7)->nullable();
            $table->foreign('district_id')->on('districts')->references('id')->onDelete('cascade');
            $table->char('village_id', 10)->nullable();
            $table->foreign('village_id')->on('villages')->references('id')->onDelete('cascade');
            $table->text('kondisi')->nullable();
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
        Schema::dropIfExists('penyintas_covid');
    }
}
