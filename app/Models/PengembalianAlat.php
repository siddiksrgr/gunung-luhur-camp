<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengembalianAlat extends Model
{
    protected $table = 'pengembalian_alat';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function sewaAlat()
    {
        return $this->belongsTo(SewaAlat::class, 'sewa_alat_id');
    }

    public function ganti()
    {
        return $this->hasOne(GantiAlatRusak::class);
    }
}
