<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cek_fisik extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kegiatan_fisik()
    {
        return $this->belongsTo(Kegiatan_fisik::class);
    }
}
