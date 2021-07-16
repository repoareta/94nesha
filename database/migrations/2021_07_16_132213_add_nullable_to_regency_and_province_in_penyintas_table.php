<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\Type;
class AddNullableToRegencyAndProvinceInPenyintasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penyintas_covid', function (Blueprint $table) {
            if (!Type::hasType('char')) {
                Type::addType('char', StringType::class);
            }
            $table->char('province_id', 2)->nullable()->change();
            $table->char('regency_id', 4)->nullable()->change();
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
            //
        });
    }
}
