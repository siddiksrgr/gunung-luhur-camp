<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function rating()
    {
        return $this->hasOne(RatingFeedback::class);
    }

    public function beliBarang()
    {
        return $this->hasMany(BeliBarang::class);
    }

    public function pesanMakan()
    {
        return $this->hasMany(PesanMakan::class);
    }
} 
