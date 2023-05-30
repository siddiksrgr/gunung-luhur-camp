<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama_shift');
            $table->string('jam_masuk');
            $table->string('jam_pulang');
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
        Schema::dropIfExists('shift_kerja');
    }
}
