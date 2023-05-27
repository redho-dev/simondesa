<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apbdes_bidang extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }
    public function apbdes_sub_bidang()
    {
        return $this->hasmany(Apbdes_sub_bidang::class);
    }
    public function apbdes_kegiatan()
    {
        return $this->hasmany(Apbdes_kegiatan::class);
    }
}
