<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkpPenelitiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skp_penelitians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_id');
            $table->string('nama_kegiatan');
            $table->string('sks_maksimal');
            $table->string('target_qty');
            $table->string('target_output');
            $table->string('target_waktu');
            $table->string('target_biaya');
            $table->string('realisasi_qty');
            $table->string('realisasi_output');
            $table->string('realisasi_waktu');
            $table->string('realisasi_biaya');
            $table->string('perhitungan');
            $table->double('nilai_capaian_skp');
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
        Schema::dropIfExists('skp_penelitians');
    }
}
