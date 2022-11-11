<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulirSkpTendiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulir_skp_tendiks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tendik_id');
            $table->string('nama_kegiatan');
            $table->string('ak_target');
            $table->string('kuant_target');
            $table->string('output_target');
            $table->string('kual_mutu_target');
            $table->string('satuan_waktu_target');
            $table->string('satuan_bulan_target');
            $table->string('biaya_target');
            $table->string('ak_realisasi');
            $table->string('kuant_realisasi');
            $table->string('output_realisasi');
            $table->string('kual_mutu_realisasi');
            $table->string('satuan_waktu_realisasi');
            $table->string('satuan_bulan_realisasi');
            $table->string('biaya_realisasi');
            $table->string('nilai_capaian_skp');
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
        Schema::dropIfExists('formulir_skp_tendiks');
    }
}
