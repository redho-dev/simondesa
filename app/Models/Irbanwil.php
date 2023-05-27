<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irbanwil extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class);
    }

    public function inspektorat()
    {
        return $this->hasMany(Inspektorat::class);
    }
}
