<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function aspek()
    {
        return $this->belongsTo(Aspek::class);
    }

    public function Sub_indikator_pemerintahan()
    {
        return $this->hasMany(Sub_indikator_pemerintahan::class);
    }

    public function Sub_indikator_keuangan()
    {
        return $this->hasMany(Sub_indikator_keuangan::class);
    }
    public function nilai_pemerintahan()
    {
        return $this->hasMany(Nilai_pemerintahan::class);
    }

    public function nilai_keuangan()
    {
        return $this->hasMany(Nilai_keuangan::class);
    }

    public function rekap_nilai_indikator()
    {
        return $this->hasMany(Rekap_nilai_indikator::class);
    }
}
