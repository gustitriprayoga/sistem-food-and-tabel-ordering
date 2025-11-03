<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Denah;
use App\Models\Meja;

class DenahMejaSelector extends Component
{
    public $denahId;
    public $selectedMejaId = null;
    public $kapasitasMinimal;

    protected $listeners = ['mejaDipilih' => 'setSelectedMeja'];

    public function mount($denahId, $selectedMejaId, $kapasitasMinimal = 1)
    {
        $this->denahId = $denahId;
        $this->selectedMejaId = $selectedMejaId;
        $this->kapasitasMinimal = $kapasitasMinimal;
    }

    public function selectMeja($mejaId)
    {
        $meja = Meja::find($mejaId);

        if ($meja && $meja->status === 'tersedia' && $meja->kapasitas >= $this->kapasitasMinimal) {
            $newMejaId = ($this->selectedMejaId === (int) $mejaId) ? null : (int) $mejaId;
            $this->selectedMejaId = $newMejaId;

            // Kirim event ke komponen induk (BookingFlow)
            $this->dispatch('mejaDipilih', mejaId: $newMejaId)->to(BookingFlow::class);
        } else {
            session()->flash('error', 'Meja tidak tersedia atau kapasitas tidak mencukupi.');
        }
    }

    public function render()
    {
        $denah = Denah::find($this->denahId);
        $mejas = collect();

        if ($denah) {
            $mejas = $denah->mejas()
                ->where('kapasitas', '>=', $this->kapasitasMinimal)
                ->whereIn('status', ['tersedia', 'dipesan'])
                ->get();
        }

        return view('livewire.denah-meja-selector', [
            'denah' => $denah,
            'mejas' => $mejas,
        ]);
    }
}
