<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspek extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function indikator()
    {
        return $this->hasMany(Indikator::class);
    }

    public function sub_indikator_pemerintahan()
    {
        return $this->hasMany(Sub_indikator_pemerintahan::class);
    }

    public function sub_indikator_keuangan()
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

    public function rekap_nilai_aspek()
    {
        return $this->hasMany(Rekap_nilai_aspek::class);
    }
}
