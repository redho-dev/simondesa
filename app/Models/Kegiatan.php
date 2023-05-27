<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;


    public function sub_bidang()
    {
        return $this->belongsTo(Sub_bidang::class);
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function apbdes_kegiatan()
    {
        return $this->hasMany(Apbdes_kegiatan::class);
    }

    public function penataanbelanja_spp()
    {
        return $this->hasMany(Penataanbelanja_spp::class);
    }
}
