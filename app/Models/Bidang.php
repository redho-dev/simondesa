<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;
    public function sub_bidang()
    {
        return $this->hasMany(Sub_bidang::class);
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }

    public function apbdes_kegiatan()
    {
        return $this->hasMany(Apbdes_kegiatan::class);
    }

    public function apbdes_sub_bidang()
    {
        return $this->hasMany(Apbdes_sub_bidang::class);
    }

    public function apbdes_bidang()
    {
        return $this->hasMany(Apbdes_bidang::class);
    }
}
