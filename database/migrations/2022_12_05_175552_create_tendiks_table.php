<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTendiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tendiks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('nip');
            $table->string('nama_tendik');
            $table->string('tmt_cpns');
            $table->string('pangkat');
            $table->string('golongan');
            $table->string('jabatan');
            $table->string('kelas_jabatan');
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tendiks');
    }
}
