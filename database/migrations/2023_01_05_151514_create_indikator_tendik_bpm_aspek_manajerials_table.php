<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndikatorTendikBpmAspekManajerialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indikator_tendik_bpm_aspek_manajerials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kriteria_aspek_manajerial_id');
            $table->text('indikator');
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
        Schema::dropIfExists('indikator_tendik_bpm_aspek_manajerials');
    }
}
