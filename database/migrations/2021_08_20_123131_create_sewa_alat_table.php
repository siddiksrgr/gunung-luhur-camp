<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSewaAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('sewa_alat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_id')->nullable();
            $table->unsignedBigInteger('alat_sewa_id');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->integer('lama_sewa');
            $table->integer('jumlah');
            $table->integer('total_bayar');
            $table->dateTimeTz('tanggal_pesan');
            $table->string('status_kembali');

            $table->foreign('pemesanan_id')->references('id')->on('pemesanan');
            $table->foreign('alat_sewa_id')->references('id')->on('alat_sewa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sewa_alat');
    }
}
