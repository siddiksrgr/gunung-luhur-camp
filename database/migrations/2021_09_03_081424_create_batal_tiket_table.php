<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatalTiketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batal_tiket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_id');
            $table->string('no_rekening');
            $table->string('atas_nama');
            $table->string('alasan');
            $table->string('status_refund')->nullable();
            $table->string('bukti_refund')->nullable();
            $table->dateTimeTz('tanggal_input');

            $table->foreign('pemesanan_id')->references('id')->on('pemesanan');
        });
    }

    /** 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batal_tiket');
    }
}
