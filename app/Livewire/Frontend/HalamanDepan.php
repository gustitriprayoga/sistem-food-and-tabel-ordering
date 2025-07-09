<?php

namespace App\Livewire\Frontend;

use App\Models\Menu;
use Livewire\Component;

class HalamanDepan extends Component
{
    public $keunggulan = [];
    public $menuPopuler = [];

    public function mount()
    {
        $this->keunggulan = [
            [
                'icon' => 'heroicon-o-sparkles',
                'judul' => 'Biji Kopi Pilihan',
                'deskripsi' => 'Kami hanya menggunakan biji kopi arabika kualitas terbaik dari berbagai daerah di Indonesia.'
            ],
            [
                'icon' => 'heroicon-o-wifi',
                'judul' => 'Suasana Nyaman & Wifi Cepat',
                'deskripsi' => 'Tempat yang sempurna untuk bekerja, bertemu teman, atau sekadar bersantai.'
            ],
            [
                'icon' => 'heroicon-o-musical-note',
                'judul' => 'Musik & Acara Komunitas',
                'deskripsi' => 'Nikmati alunan musik pilihan dan ikuti acara-acara menarik yang kami adakan.'
            ]
        ];

        $this->menuPopuler = Menu::with('variasiMenu')
            ->where('tersedia', true)
            ->inRandomOrder()
            ->limit(6)
            ->get();
    }

    public function render()
    {
        return view('livewire.frontend.halaman-depan')
            ->layout('components.layouts.app');
    }
}
