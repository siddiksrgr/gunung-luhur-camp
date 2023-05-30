<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'nama' => 'Admin',
                'jenis_kelamin' => 'Laki-laki',
                'no_hp' => '089876675445',
                'alamat' => 'Bogor',
                'username' => 'admin',
                'password' => bcrypt('admin123'),
                'level' => 'admin',
                'tanggal_daftar' => '2020-11-09 18:33:29',
            ],
            [
                'nama' => 'Pengelola',
                'jenis_kelamin' => 'Laki-laki',
                'no_hp' => '089876675444',
                'alamat' => 'Bogor',
                'username' => 'pengelola',
                'password' => bcrypt('pengelola123'),
                'level' => 'pengelola',
                'tanggal_daftar' => '2020-11-09 18:33:29',
            ]
        ]);
    }
}
