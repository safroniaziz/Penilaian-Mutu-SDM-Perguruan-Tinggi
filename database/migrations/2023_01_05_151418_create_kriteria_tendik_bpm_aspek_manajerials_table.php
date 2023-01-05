<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriaTendikBpmAspekManajerialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriteria_tendik_bpm_aspek_manajerials', function (Blueprint $table) {
            $table->id();
            $table->String('kriteria');
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
        Schema::dropIfExists('kriteria_tendik_bpm_aspek_manajerials');
    }
}
