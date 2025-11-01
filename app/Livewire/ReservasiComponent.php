<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Meja;
use App\Models\Reservasi;

class ReservasiComponent extends Component
{
    // ... (Properti yang sama seperti sebelumnya)
    public $step = 1;
    public $tanggal_reservasi;
    public $waktu_reservasi;
    public $jumlah_orang;
    public $meja_id = null;
    public $catatan;
    public $total_bayar = 50000; // Contoh DP reservasi
    public $metode_pembayaran;
    public $reservasiBerhasil = false;
    public $kodeReservasi;
    public $mejaTersedia = [];

    protected $rules = [
        'tanggal_reservasi' => 'required|date|after_or_equal:today',
        'waktu_reservasi' => 'required|date_format:H:i',
        'jumlah_orang' => 'required|integer|min:1',
        'meja_id' => 'nullable|exists:mejas,id', // Diisi di step 2
        'metode_pembayaran' => 'required|in:kasir,transfer_bank,e_wallet',
    ];

    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validate(['tanggal_reservasi', 'waktu_reservasi', 'jumlah_orang']);

            // Logika mencari meja yang cukup kapasitas dan status tersedia (disini masih sederhana)
            $this->mejaTersedia = Meja::where('kapasitas', '>=', $this->jumlah_orang)
                ->where('status', 'tersedia')
                ->get();

            if ($this->mejaTersedia->isEmpty()) {
                session()->flash('error', 'Maaf, tidak ada meja yang tersedia untuk kapasitas tersebut.');
                return;
            }

            $this->step = 2;
        } elseif ($this->step === 2) {
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
        // Validasi Akhir di Step 3
        $this->validate();

        // Simpan data reservasi sementara ke session untuk halaman pembayaran
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
        return view('livewire.reservasi-component')
            ->layout('components.layouts.app', ['title' => 'Reservasi Meja']);
    }
}
