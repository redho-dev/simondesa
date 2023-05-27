<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai_bumd extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function asal()
    {
        return $this->belongsTo(Asal::class);
    }
}
