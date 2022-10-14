<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBkdPendidikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bkd_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kegiatan');
            $table->string('bukti_penugasan');
            $table->string('sks_beban_kerja');
            $table->string('masa_tugas');
            $table->string('bukti_dokumen');
            $table->string('persentase_capaian');
            $table->string('sks_kinerja');
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
        Schema::dropIfExists('bkd_pendidikans');
    }
}
