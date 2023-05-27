<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penataan_pembiayaan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function apbdes_pembiayaan()
    {
        return $this->hasOne(Apbdes_pembiayaan::class);
    }

    public function Pembiayaan()
    {
        return $this->belongsTo(Pembiayaan::class);
    }
}
