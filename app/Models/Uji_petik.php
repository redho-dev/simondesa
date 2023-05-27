<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uji_petik extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function apbdes_kegiatan()
    {
        return $this->belongsTo(Apbdes_kegiatan::class);
    }

    public function penataanbelanja_bkp()
    {
        return $this->belongsTo(Penataanbelanja_bkp::class);
    }
}
