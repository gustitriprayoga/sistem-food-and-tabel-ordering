<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Denah;
use App\Models\Meja;

class DenahMejaSelector extends Component
{
    public $denahId;
    // Properti ini di-bind (terhubung) dengan properti selectedMejaId di MenuPage
    public $selectedMejaId = null;

    // Menerima event dari parent atau dari inisialisasi mount
    protected $listeners = ['mejaDipilih' => 'setSelectedMeja'];

    public function mount($denahId, $selectedMejaId)
    {
        $this->denahId = $denahId;
        $this->selectedMejaId = $selectedMejaId;
    }

    // Fungsi yang dipanggil saat user mengklik meja di view
    public function selectMeja($mejaId)
    {
        $meja = Meja::find($mejaId);

        // Hanya izinkan pemilihan jika statusnya 'tersedia'
        if ($meja && $meja->status === 'tersedia') {
            // Toggle selection (pilih/batalkan pilihan)
            $newMejaId = ($this->selectedMejaId === (int) $mejaId) ? null : (int) $mejaId;
            $this->selectedMejaId = $newMejaId;

            // Kirim event ke komponen induk (MenuPage) untuk update state keranjang/pesanan
            $this->dispatch('mejaDipilih', mejaId: $newMejaId)->to(MenuPage::class);
        }
    }

    public function render()
    {
        // PENTING: Gunakan with('mejas') untuk memuat meja yang terkait
        $denah = Denah::with('mejas')->find($this->denahId);
        $mejas = $denah->mejas ?? collect();

        return view('livewire.denah-meja-selector', [
            'denah' => $denah,
            'mejas' => $mejas,
        ]);
    }
}
