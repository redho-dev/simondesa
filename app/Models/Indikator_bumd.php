<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator_bumd extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function nilai_bumd()
    {
        return $this->hasMany(Nilai_bumd::class);
    }
}
