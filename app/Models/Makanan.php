<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    protected $table = 'makanan';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function pesanMakan()
    {
        return $this->hasMany(PesanMakan::class);
    }
}
