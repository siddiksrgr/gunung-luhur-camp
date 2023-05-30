<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konfirmasi extends Model
{
    protected $table = 'konfirmasi';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
