<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPiket extends Model
{
    protected $table = 'jadwal_piket';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function shift()
    {
        return $this->belongsTo(ShiftKerja::class, 'shift_kerja_id');
    }
}
