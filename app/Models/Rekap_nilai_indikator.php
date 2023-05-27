<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap_nilai_indikator extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function indikator()
    {
        return $this->belongsTo(Indikator::class);
    }

    public function aspek()
    {
        return $this->belongsTo(Aspek::class);
    }
    
}
