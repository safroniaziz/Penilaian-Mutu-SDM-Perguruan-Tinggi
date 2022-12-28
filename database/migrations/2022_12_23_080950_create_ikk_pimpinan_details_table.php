<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIkkPimpinanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ikk_pimpinan_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ikk_pimpinan_detail_id');
            $table->string('judul_ikk');
            $table->string('keterangan_ikk');
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
        Schema::dropIfExists('ikk_pimpinan_details');
    }
}
