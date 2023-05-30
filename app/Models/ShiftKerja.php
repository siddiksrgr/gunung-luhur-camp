<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShiftKerja extends Model
{
    protected $table = 'shift_kerja';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function jadwalPiket()
    {
        return $this->hasMany(JadwalPiket::class);
    }
}
