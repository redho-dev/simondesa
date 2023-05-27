<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function admin()
    {
        return $this->hasMany(Admin::class);
    }

    public function nilai_pemerintahan()
    {
        return $this->hasMany(Nilai_pemerintahan::class);
    }
    public function nilai_keuangan()
    {
        return $this->hasMany(Nilai_keuangan::class);
    }
    public function nilai_bumd()
    {
        return $this->hasMany(Nilai_bumd::class);
    }
}
