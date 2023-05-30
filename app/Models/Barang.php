<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function beliBarang()
    {
        return $this->hasMany(BeliBarang::class);
    }
}
