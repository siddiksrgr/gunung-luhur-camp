<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanMakanTable extends Migration
{
    /**
     * Run the migrations. 
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan_makan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('makanan_id');
            $table->integer('jumlah');
            $table->integer('total_bayar');
            $table->dateTimeTz('tanggal_pesan');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('makanan_id')->references('id')->on('makanan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesan_makan');
    }
}
