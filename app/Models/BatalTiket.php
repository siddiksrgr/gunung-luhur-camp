<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatalTiket extends Model
{
    protected $table = 'batal_tiket';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
