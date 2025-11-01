<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Meja;

class ReservasiPage extends Component
{
    public $step = 1;
    public $tanggal_reservasi;
    public $waktu_reservasi;
    public $jumlah_orang;
    public $meja_id = null;
    public $catatan;
    public $total_bayar = 50000;
    public $metode_pembayaran;
    public $mejaTersedia = [];

    protected $rules = [
        'tanggal_reservasi' => 'required|date|after_or_equal:today',
        'waktu_reservasi' => 'required|date_format:H:i',
        'jumlah_orang' => 'required|integer|min:1',
        'meja_id' => 'nullable|exists:mejas,id',
        'metode_pembayaran' => 'required|in:kasir,transfer_bank,e_wallet',
    ];

    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validate(['tanggal_reservasi', 'waktu_reservasi', 'jumlah_orang']);

            $this->mejaTersedia = Meja::where('kapasitas', '>=', $this->jumlah_orang)
                                    ->where('status', 'tersedia')
                                    ->get();

            if ($this->mejaTersedia->isEmpty()) {
                session()->flash('error', 'Maaf, tidak ada meja yang tersedia untuk kapasitas tersebut.');
                return;
            }

            $this->step = 2;
        }
        elseif ($this->step === 2) {
            $this->validate(['meja_id' => 'required|exists:mejas,id']);
            $this->step = 3;
        }
    }

    public function selectMeja($mejaId)
    {
        $this->meja_id = $mejaId;
    }

    public function checkoutReservasi()
    {
        $this->validate();

        session()->put('order_data', [
            'type' => 'reservasi',
            'meja_id' => $this->meja_id,
            'tanggal' => $this->tanggal_reservasi,
            'waktu' => $this->waktu_reservasi,
            'jumlah_orang' => $this->jumlah_orang,
            'dp_amount' => $this->total_bayar,
            'catatan' => $this->catatan,
            'metode_pembayaran' => $this->metode_pembayaran,
        ]);

        return redirect()->route('pembayaran.index');
    }

    public function render()
    {
        return view('livewire.reservasi-page')
            ->layout('components.layouts.app', ['title' => 'Reservasi Meja']);
    }
}
