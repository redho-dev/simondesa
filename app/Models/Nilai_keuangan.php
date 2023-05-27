<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai_keuangan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sub_indikator_keuangan()
    {
        return $this->belongsTo(Sub_indikator_keuangan::class);
    }

    public function indikator()
    {
        return $this->belongsTo(Indikator::class);
    }

    public function aspek()
    {
        return $this->belongsTo(Aspek::class);
    }
}
