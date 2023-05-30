<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanMakan extends Model
{
    protected $table = 'pesan_makan';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function makanan()
    {
        return $this->belongsTo(Makanan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
