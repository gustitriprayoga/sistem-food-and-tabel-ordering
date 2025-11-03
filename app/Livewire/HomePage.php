<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu;
use App\Models\VariasiMenu;

class HomePage extends Component
{
    public function render()
    {
        // KOREKSI: Gunakan whereHas untuk memastikan variasi menu tersedia
        $featuredMenus = Menu::where('tersedia', true)
            // Hapus whereNotNull('gambar') agar menu tanpa gambar juga ditampilkan sementara untuk debug.
            ->with(['variasiMenus' => function ($query) {
                // Memastikan variasi dimuat jika tersedia
                $query->where('tersedia', true);
            }])
            // WAJIB: Gunakan whereHas untuk memastikan menu memiliki variasi yang tersedia
            ->whereHas('variasiMenus', function ($query) {
                $query->where('tersedia', true);
            })
            ->take(6)
            ->get();

        return view('livewire.home-page', [
            'featuredMenus' => $featuredMenus,
        ])->layout('components.layouts.app', ['title' => 'Niskala Cafe']);
    }
}
