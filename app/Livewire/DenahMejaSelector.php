<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Denah;
use App\Models\Meja;

class DenahMejaSelector extends Component
{
    public $denahId;
    public $selectedMejaId = null;

    protected $listeners = ['mejaDipilih' => 'setSelectedMeja'];

    public function mount($denahId, $selectedMejaId)
    {
        $this->denahId = $denahId;
        $this->selectedMejaId = $selectedMejaId;
    }

    public function selectMeja($mejaId)
    {
        $meja = Meja::find($mejaId);
        if ($meja && $meja->status === 'tersedia') {
            $newMejaId = ($this->selectedMejaId === $mejaId) ? null : $mejaId;
            $this->selectedMejaId = $newMejaId;

            // Kirim event ke komponen induk (MenuPage)
            $this->dispatch('mejaDipilih', mejaId: $newMejaId);
        }
    }

    public function render()
    {
        $denah = Denah::with('mejas')->find($this->denahId);
        $mejas = $denah->mejas ?? collect();

        return view('livewire.denah-meja-selector', [
            'denah' => $denah,
            'mejas' => $mejas,
        ]);
    }
}
