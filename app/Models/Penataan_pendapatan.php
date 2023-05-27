<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penataan_pendapatan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pendapatan()
    {
        return $this->belongsTo(Pendapatan::class);
    }

    public function apbdes_pendapatan()
    {
        return $this->belongsTo(Apbdes_pendapatan::class);
    }
}
