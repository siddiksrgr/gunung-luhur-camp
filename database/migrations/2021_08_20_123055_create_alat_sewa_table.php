<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlatSewaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alat_sewa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('kapasitas')->nullable();
            $table->integer('harga_sewa');
            $table->integer('harga_beli');
            $table->string('foto');
            $table->integer('sedang_disewa');
            $table->integer('stok');
            $table->string('keterangan')->nullable();
            $table->dateTimeTz('tanggal_input');
            $table->dateTimeTz('tanggal_update');
        });
    }

    /**
     * Reverse the migrations. 
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alat_sewa');
    }
}
