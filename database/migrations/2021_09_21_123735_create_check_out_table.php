<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_out', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('check_in_id');
            $table->dateTimeTz('tanggal_input');

            $table->foreign('check_in_id')->references('id')->on('check_in');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_out');
    }
}
