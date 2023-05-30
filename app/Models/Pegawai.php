<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function jadwalPiket()
    {
        return $this->hasMany(JadwalPiket::class);
    }
}
