<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlatSewa extends Model
{
    protected $table = 'alat_sewa';
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];

    public function sewaAlat()
    {
        return $this->hasMany(SewaAlat::class);
    }
}
