<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penataanbelanja_spp extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function apbdes_kegiatan()
    {
        return $this->belongsTo(Apbdes_kegiatan::class);
    }
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
