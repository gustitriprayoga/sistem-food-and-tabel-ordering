<?php

namespace App\Livewire;

use Livewire\Component;

class MejaTester extends Component
{
    // ID Denah yang PASTI ada di database Anda
    public $denahIdTest = 1;
    public $kapasitasTest = 2;

    public function render()
    {
        return view('livewire.meja-tester')
            ->layout('components.layouts.app', ['title' => 'Uji Coba Tampilan Meja']);
    }
}
