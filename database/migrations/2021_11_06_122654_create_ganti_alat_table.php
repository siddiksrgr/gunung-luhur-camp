<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGantiAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ganti_alat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengembalian_alat_id');
            $table->integer('total_ganti');
            $table->string('status');
            $table->dateTimeTz('tanggal_input');

            $table->foreign('pengembalian_alat_id')->references('id')->on('pengembalian_alat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ganti_alat');
    }
}
