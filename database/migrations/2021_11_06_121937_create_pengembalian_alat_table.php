<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembalianAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalian_alat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sewa_alat_id');
            $table->integer('jumlah_kembali');
            $table->integer('jumlah_bagus');
            $table->integer('jumlah_rusak');
            $table->dateTimeTz('tanggal_input');

            $table->foreign('sewa_alat_id')->references('id')->on('sewa_alat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembalian_alat');
    }
}
