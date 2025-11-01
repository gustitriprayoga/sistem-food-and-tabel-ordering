<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservasi;
use Illuminate\Support\Str;

class PembayaranComponent extends Component
{
    // ... (Properti yang sama seperti sebelumnya)
    public $orderData;
    public $tipePesanan;
    public $totalBayar;
    public $metode_pembayaran;
    public $catatan;
    public $uploadingBukti = false;

    protected $rules = [
        'metode_pembayaran' => 'required|in:kasir,transfer_bank,e_wallet',
        'catatan' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        $this->orderData = session()->get('order_data');

        if (!$this->orderData) {
            session()->flash('error', 'Tidak ada data pesanan yang ditemukan. Silakan mulai pemesanan ulang.');
            return redirect()->route('homepage');
        }

        $this->tipePesanan = $this->orderData['type'];

        if ($this->tipePesanan == 'menu') {
            $this->totalBayar = array_sum(array_map(fn($item) => $item['harga'] * $item['jumlah'], $this->orderData['cart']));
        } elseif ($this->tipePesanan == 'reservasi') {
            $this->totalBayar = $this->orderData['dp_amount'];
            // Isi data reservasi yang sudah dipilih sebelumnya
            $this->metode_pembayaran = $this->orderData['metode_pembayaran'] ?? null;
            $this->catatan = $this->orderData['catatan'] ?? null;
        }
    }

    public function completeOrder()
    {
        $this->validate();

        $kode = 'NKL-' . strtoupper(Str::random(6));
        $statusPembayaran = $this->metode_pembayaran == 'kasir' ? 'pending' : 'menunggu_konfirmasi';

        if ($this->tipePesanan == 'reservasi') {
            // Logika Penyimpanan Reservasi dari data sesi
            $reservasi = Reservasi::create([
                'kode_reservasi' => $kode,
                'meja_id' => $this->orderData['meja_id'],
                'tanggal_reservasi' => $this->orderData['tanggal'],
                'waktu_reservasi' => $this->orderData['waktu'],
                'jumlah_orang' => $this->orderData['jumlah_orang'],
                'catatan' => $this->catatan,
                'total_bayar' => $this->totalBayar,
                'metode_pembayaran' => $this->metode_pembayaran,
                'status_pembayaran' => $statusPembayaran,
                'tipe_pesanan' => 'makan_ditempat',
                'status' => 'pending',
            ]);
        } elseif ($this->tipePesanan == 'menu') {
            // Logika Penyimpanan Pemesanan Menu dari data sesi
            $reservasi = Reservasi::create([
                'kode_reservasi' => $kode,
                'meja_id' => $this->orderData['meja_id'] ?? null,
                'tanggal_reservasi' => now()->toDateString(),
                'waktu_reservasi' => now()->toTimeString(),
                'jumlah_orang' => 0,
                'catatan' => $this->catatan,
                'total_bayar' => $this->totalBayar,
                'metode_pembayaran' => $this->metode_pembayaran,
                'status_pembayaran' => $statusPembayaran,
                'tipe_pesanan' => $this->orderData['meja_id'] ? 'makan_ditempat' : 'bawa_pulang',
                'status' => $this->metode_pembayaran == 'kasir' ? 'pending' : 'dikonfirmasi',
            ]);

            // Simpan detail menu
            foreach ($this->orderData['cart'] as $variasi_id => $item) {
                $reservasi->detailReservasis()->create([
                    'variasi_menu_id' => $variasi_id,
                    'jumlah' => $item['jumlah'],
                    'harga_saat_pesan' => $item['harga'],
                ]);
            }
        }

        // Bersihkan session
        session()->forget('order_data');

        return redirect()->route('pembayaran.sukses', ['kode' => $kode]);
    }

    public function render()
    {
        return view('livewire.pembayaran-component')->layout('components.layouts.app', ['title' => 'Pembayaran']);
    }
}
