<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembiayaan extends Model
{
    use HasFactory;

    public function apbdes_pembiayaan()
    {
        return $this->hasMany(Apbdes_pembiayaan::class);
    }

    public function penataan_pembiayaan()
    {
        return $this->hasMany(penataan_pembiayaan::class);
    }
}
