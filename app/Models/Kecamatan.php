<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function asal()
    {
        return $this->hasMany(Asal::class);
    }

    public function irbanwil()
    {
        return $this->belongsTo(Irbanwil::class);
    }
}
