<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilReviewManajerialTendikDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_review_manajerial_tendik_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hasil_review_manajerial_tendik_id');
            $table->unsignedBigInteger('indikator_id');
            $table->integer('nilai');
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
        Schema::dropIfExists('hasil_review_manajerial_tendik_details');
    }
}
