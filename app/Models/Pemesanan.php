<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesanTiket()
    {
        return $this->hasOne(PesanTiket::class);
    }

    public function sewaAlat()
    {
        return $this->hasMany(SewaAlat::class);
    }

    public function konfirmasi()
    {
        return $this->hasOne(Konfirmasi::class);
    }

    public function batalTiket()
    {
        return $this->hasOne(BatalTiket::class);
    }

    public function checkIn()
    {
        return $this->hasOne(CheckIn::class);
    }
}
