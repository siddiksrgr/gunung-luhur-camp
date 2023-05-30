<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SewaAlatTambah extends Model
{
    protected $table = 'sewa_alat_tambah';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function checkIn()
    {
        return $this->belongsTo(CheckIn::class, 'check_in_id');
    }

    public function sewaAlat()
    {
        return $this->belongsTo(SewaAlat::class, 'sewa_alat_id');
    }
}
