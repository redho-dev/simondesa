<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belanja extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function apbdes_belanjaakun()
    {
        return $this->hasMany(Apbdes_belanjaakun::class);
    }
}
