<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIkkPimpinansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ikk_pimpinans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('pimpinan_id');
            $table->string('nama_pimpinan');
            $table->string('nip_pimpinan');
            $table->string('nidn_pimpinan');
            $table->string('jabatan_pimpinan');
            $table->string('pangkat_pimpinan');
            $table->string('golongan_pimpinan');
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
        Schema::dropIfExists('ikk_pimpinans');
    }
}
