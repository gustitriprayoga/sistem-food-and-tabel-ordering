<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }


    public function detailReservasi()
    {
        return $this->hasMany(DetailReservasi::class);
    }

    public function detailReservasis()
    {
        return $this->hasMany(DetailReservasi::class);
    }
}

