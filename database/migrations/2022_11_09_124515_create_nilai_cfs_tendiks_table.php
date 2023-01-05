<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiCfsTendiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_cfs_tendiks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indikator_id');
            $table->unsignedBigInteger('tendik_id');
            $table->integer('skor');
            $table->string('keterangan');
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
        Schema::dropIfExists('nilai_cfs_tendiks');
    }
}
