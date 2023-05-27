<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_indikator_pemerintahan extends Model
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

    public function nilai_pemerintahan()
    {
        return $this->hasMany(Nilai_pemerintahan::class);
    }
}
