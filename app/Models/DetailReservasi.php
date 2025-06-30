<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReservasi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function kategoriMenu()
    {
        return $this->belongsTo(KategoriMenu::class);
    }

    public function variasiMenu()
    {
        return $this->belongsTo(VariasiMenu::class);
    }


}
