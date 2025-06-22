<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }
}
