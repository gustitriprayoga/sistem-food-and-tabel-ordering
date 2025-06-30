<?php

namespace App\Filament\Pages;

use App\Models\Denah; // <-- Import model Denah
use Filament\Pages\Page;

class DenahInteraktif extends Page
{
    protected static string $view = 'filament.pages.denah-interaktif';

    protected static ?string $navigationGroup = 'Manajemen Meja';

    protected static ?string $title = 'Denah Interaktif';

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole(['admin']);
    }


    // Properti untuk menyimpan data denah yang akan dikirim ke view
    public $semuaDenah;

    // Method mount() akan dijalankan saat halaman pertama kali dimuat
    public function mount(): void
    {
        // Ambil semua denah dari database dan kirimkan ke properti publik
        $this->semuaDenah = Denah::where('aktif', true)->get();

    }
}
