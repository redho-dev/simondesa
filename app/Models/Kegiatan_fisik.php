<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan_fisik extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function apbdes_kegiatan()
    {
        return $this->belongsTo(Apbdes_kegiatan::class);
    }

    public function pengadaan()
    {
        return $this->hasMany(Pengadaan::class);
    }

    public function cek_fisik()
    {
        return $this->hasMany(Cek_fisik::class);
    }
}
