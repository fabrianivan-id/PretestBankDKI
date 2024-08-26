<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function rekening()
    {
        return $this->hasMany(Rekening::class, 'province_id');
    }
}
