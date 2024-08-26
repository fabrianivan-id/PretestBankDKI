<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    public function rekening()
    {
        return $this->hasMany(Rekening::class, 'pekerjaan_id');
    }
}
