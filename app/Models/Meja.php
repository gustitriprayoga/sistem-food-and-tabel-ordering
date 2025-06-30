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

    public function meja()
    {
        // Parameter kedua ('denah_id') adalah foreign key di tabel 'meja'
        // Parameter ketiga ('id') adalah primary key di tabel 'denah'
        return $this->hasMany(Meja::class, 'denah_id', 'id');
    }
}
