<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_indikator_keuangan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function nilai_keuangan()
    {
        return $this->hasMany(Nilai_keuangan::class);
    }
    public function indikator()
    {
        return $this->belongsTo(Indikator::class);
    }
}
