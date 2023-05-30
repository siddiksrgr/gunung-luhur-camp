<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    protected $table = 'check_in';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function checkOut()
    {
        return $this->hasOne(CheckOut::class);
    }

    public function sewaTambah()
    {
        return $this->hasMany(SewaAlatTambah::class);
    }
}
