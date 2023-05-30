<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SewaAlat extends Model
{
    protected $table = 'sewa_alat';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function alatSewa()
    {
        return $this->belongsTo(AlatSewa::class);
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function pengembalian()
    {
        return $this->hasOne(PengembalianAlat::class);
    }

    public function sewaAlatTambah()
    {
        return $this->hasOne(SewaAlatTambah::class);
    }
}
