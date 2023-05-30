<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaTiket extends Model
{
    protected $table = 'harga_tiket';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function pesanTiket()
    {
        return $this->hasOne(PesanTiket::class);
    }
}
