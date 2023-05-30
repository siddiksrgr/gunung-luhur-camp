<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GantiAlatRusak extends Model
{
    protected $table = 'ganti_alat';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function pengembalian()
    {
        return $this->belongsTo(PengembalianAlat::class, 'pengembalian_alat_id');
    }
}
