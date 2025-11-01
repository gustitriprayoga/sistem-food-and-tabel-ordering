<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function variasiMenu()
    {
        return $this->hasMany(VariasiMenu::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriMenu::class);
    }

    public function detailReservasi()
    {
        return $this->hasMany(DetailReservasi::class);
    }

    public function variasiMenus()
    {
        return $this->hasMany(VariasiMenu::class, 'menu_id');
    }
}
