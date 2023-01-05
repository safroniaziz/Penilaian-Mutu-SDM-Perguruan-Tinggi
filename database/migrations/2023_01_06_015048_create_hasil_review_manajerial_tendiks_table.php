<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilReviewManajerialTendiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_review_manajerial_tendiks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('reviewer_id');
            $table->unsignedBigInteger('pegawai_id');
            $table->enum('status',['dosen','pegawai']);
            $table->string('total');
            $table->string('rata_rata');
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
        Schema::dropIfExists('hasil_review_manajerial_tendiks');
    }
}
