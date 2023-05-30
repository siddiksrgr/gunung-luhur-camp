<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSewaAlatTambahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sewa_alat_tambah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('check_in_id');
            $table->unsignedBigInteger('sewa_alat_id');

            $table->foreign('check_in_id')->references('id')->on('check_in');
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
        Schema::dropIfExists('sewa_alat_tambah');
    }
}
