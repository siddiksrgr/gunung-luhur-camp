<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    protected $table = 'check_out';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function checkIn()
    {
        return $this->belongsTo(CheckIn::class);
    }
}
