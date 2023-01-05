<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkpDosenDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skp_dosen_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skp_dosen_id');
            $table->unsignedBigInteger('ikk_pimpinan_id');
            $table->text('isi_ikk');
            $table->text('target_ikk');
            $table->text('realisasi_bukti_dukung');
            $table->text('umpan_balik_berkelanjutan');
            $table->enum('angka',['1','2','3']);
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
        Schema::dropIfExists('skp_karyawan_details');
    }
}
