<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanTiket extends Model
{
    protected $table = 'pesan_tiket';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function hargaTiket()
    {
        return $this->belongsTo(HargaTiket::class);
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
