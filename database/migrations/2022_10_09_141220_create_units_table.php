<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pimpinan_id')->nullable();
            $table->string('nama_pimpinan')->nullable();
            $table->enum('status_pimpinan',['dosen','tendik'])->nullable();
            $table->string('nama_unit');
            $table->string('nama_singkatan')->nullable();
            $table->enum('jenis_unit',['fakultas','upt','lembaga','lainnya']);
            $table->string('fakultas_kode')->nullable();
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
        Schema::dropIfExists('units');
    }
}
