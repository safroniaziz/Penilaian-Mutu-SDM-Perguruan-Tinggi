<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndikatorBanPtDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indikator_ban_pt_dosens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bab_indikator_ban_pt_dosen_id');
            $table->text('indikator');
            $table->text('keterangan');
            $table->integer('skor');
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
        Schema::dropIfExists('indikator_ban_pt_dosens');
    }
}
