<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkpDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skp_dosens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_id');
            $table->unsignedBigInteger('pejabat_penilai_id');
            $table->unsignedBigInteger('atasan_pejabat_penilai_id');
            $table->enum('triwulan',['1','2','3','4']);
            $table->date('periode_awal');
            $table->date('periode_akhir');
            $table->string('capaian_kinerja_organisasi');
            $table->date('ttd_pejabat');
            $table->date('ttd_pejabat_penilai');
            $table->date('ttd_atasan_pejabat_penilai');
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
        Schema::dropIfExists('skp_dosens');
    }
}
