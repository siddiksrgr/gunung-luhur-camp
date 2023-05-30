<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanTiketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan_tiket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_id');
            $table->unsignedBigInteger('harga_tiket_id');
            $table->date('tgl_check_in');
            $table->date('tgl_check_out');
            $table->integer('lama_menginap');
            $table->integer('total_anggota');
            $table->integer('total_bayar');
            $table->dateTimeTz('tanggal_pesan');

            $table->foreign('pemesanan_id')->references('id')->on('pemesanan');
            $table->foreign('harga_tiket_id')->references('id')->on('harga_tiket');
        });
    }

    /** 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesan_tiket');
    }
}
