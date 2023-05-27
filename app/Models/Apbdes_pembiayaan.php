<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apbdes_pembiayaan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pembiayaan()
    {
        return $this->belongsTo(Pembiayaan::class);
    }

    public function penataan_pembiayaan()
    {
        return $this->hasOne(Penataan_pembiayaan::class);
    }
}
