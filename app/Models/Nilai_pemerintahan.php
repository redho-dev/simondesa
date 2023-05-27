<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai_pemerintahan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function aspek()
    {
        return $this->belongsTo(Aspek::class);
    }

    public function indikator()
    {
        return $this->belongsTo(Indikator::class);
    }

    public function sub_indikator_pemerintahan()
    {
        return $this->belongsTo(Sub_indikator_pemerintahan::class);
    }

    public function asal()
    {
        return $this->belongsTo(Asal::class);
    }
}
