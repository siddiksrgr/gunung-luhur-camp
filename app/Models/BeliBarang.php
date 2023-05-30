<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeliBarang extends Model
{
    protected $table = 'beli_barang';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
