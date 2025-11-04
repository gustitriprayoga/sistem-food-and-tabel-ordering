<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservasi; // Pastikan Model Reservasi di-import

class CheckReservasi extends Component
{
    public $kodeReservasi = '';
    public $reservasiData = null;
    public $searchAttempted = false;

    protected $rules = [
        'kodeReservasi' => 'required|string|min:6',
    ];

    // Fungsi untuk mencari reservasi berdasarkan kode
    public function checkCode()
    {
        $this->validate();
        $this->searchAttempted = true;
        $this->reservasiData = null;

        // Cari reservasi di database
        $reservasi = Reservasi::where('kode_reservasi', $this->kodeReservasi)->first();

        if ($reservasi) {
            // Eager load detail menu jika ada
            $this->reservasiData = $reservasi->load('detailReservasis.variasiMenu.menu');
        }
    }

    public function render()
    {
        return view('livewire.check-reservasi')
            ->layout('components.layouts.app', ['title' => 'Cek Status Reservasi']);
    }
}
