<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    public $timestamps = false;
    protected $table = 'lokasi';
    protected $guarded  = [
        'id'
    ];
}
