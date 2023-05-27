<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspektorat extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function irbanwil()
    {
        return $this->belongsTo(Irbanwil::class);
    }
}
