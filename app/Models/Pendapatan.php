<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function apbdes_pendapatan()
    {
        return $this->hasMany(Apbdes_pendapatan::class);
    }

    public function penataan_pendapatan()
    {
        return $this->hasMany(Penataan_pendapatan::class);
    }
}
