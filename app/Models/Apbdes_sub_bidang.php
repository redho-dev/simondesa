<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apbdes_sub_bidang extends Model
{
    use HasFactory;
    protected $guarded = [];

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

    public function apbdes_kegiatan()
    {
        return $this->hasMany(Apbdes_kegiatan::class);
    }
}
