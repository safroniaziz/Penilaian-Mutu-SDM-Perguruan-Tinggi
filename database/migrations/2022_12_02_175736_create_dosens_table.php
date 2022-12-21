<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi_id');
            $table->string('nama_dosen');
            $table->string('nidn');
            $table->string('jabatan_akademik');
            $table->string('gelar_depan');
            $table->string('gelar_belakang');
            $table->string('jenis_kelamin')->nullable();
            $table->string('golongan');
            $table->string('kedudukan_hukum');
            $table->string('tugas_tambahan')->nullable();
            $table->string('pendidikan_akhir');
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
        Schema::dropIfExists('dosens');
    }
}
