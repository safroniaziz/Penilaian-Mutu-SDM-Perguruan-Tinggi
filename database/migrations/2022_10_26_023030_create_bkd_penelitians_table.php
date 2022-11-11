<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBkdPenelitiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bkd_penelitians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_id');
            $table->string('jenis_kegiatan');
            $table->string('bukti_penugasan');
            $table->string('sks_beban_kerja');
            $table->string('masa_tugas');
            $table->string('bukti_dokumen');
            $table->string('persentase_capaian');
            $table->string('sks_kinerja');
            $table->timestamps();

            $table->foreign('dosen_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bkd_penelitians');
    }
}
