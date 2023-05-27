<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_bidang extends Model
{
    use HasFactory;
    protected $with = 'kegiatan';
    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
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
}
