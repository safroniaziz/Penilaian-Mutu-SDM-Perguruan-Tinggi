<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenPasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen_pas', function (Blueprint $table) {
            $table->id();
            $table->string('dosen_id');
            $table->string('npm_mahasiswa');
            $table->string('nama_mahasiswa');
            $table->string('prodi');
            $table->string('angkatan');
            $table->string('jenis_kelamin')->nullable();
            $table->timestamps();

            $table->foreign('dosen_id')->references('id')->on('dosens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosen_pas');
    }
}
