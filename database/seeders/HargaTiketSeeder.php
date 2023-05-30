<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HargaTiket;

class HargaTiketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HargaTiket::create([
            'harga' => 20000,
            'keterangan' => 'per orang',
            'tanggal_update' => '2020-11-09 18:33:29',
        ]);
    }
}
