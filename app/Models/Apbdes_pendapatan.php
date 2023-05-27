<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apbdes_pendapatan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pendapatan()
    {
        return $this->belongsTo(Pendapatan::class);
    }
    public function penataan_pendapatan()
    {
        return $this->hasMany(Penataan_pendapatan::class);
    }
}
