<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apbdes_kegiatan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
    public function sub_bidang()
    {
        return $this->belongsTo(Sub_bidang::class);
    }
    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function apbdes_bidang()
    {
        return $this->belongsTo(Apbdes_bidang::class);
    }

    public function apbdes_sub_bidang()
    {
        return $this->belongsTo(Apbdes_sub_bidang::class);
    }

    public function penataanbelanja_spp()
    {
        return $this->hasMany(Penataanbelanja_spp::class);
    }

    public function penataanbelanja_bkp()
    {
        return $this->hasMany(Penataanbelanja_bkp::class);
    }

    public function asal()
    {
        return $this->belongsTo(Asal::class);
    }

    public function uji_petik()
    {
        return $this->hasMany(Uji_petik::class);
    }
    public function pengadaan()
    {
        return $this->hasMany(Pengadaan::class);
    }

    public function pengadaan_aset()
    {
        return $this->hasMany(Pengadaan_aset::class);
    }

    public function Pengadaan_asetnonlapor()
    {
        return $this->hasMany(Pengadaan_asetnonlapor::class);
    }
}
