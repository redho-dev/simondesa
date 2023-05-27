<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap_nilai_aspek extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function aspek()
    {
        return $this->belongsTo(Aspek::class);
    }

    public function asal()
    {
        return $this->belongsTo(Asal::class);
    }
}
