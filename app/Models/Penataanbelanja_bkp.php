<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penataanbelanja_bkp extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function apbdes_kegiatan()
    {
        return $this->belongsTo(Apbdes_kegiatan::class);
    }
    public function belanja()
    {
        return $this->belongsTo(Belanja::class);
    }

    public function uji_petik()
    {
        return $this->hasMany(Uji_petik::class);
    }
}
