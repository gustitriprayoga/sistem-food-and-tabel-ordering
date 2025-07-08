<?php
// File: app/Livewire/Frontend/HalamanDepan.php

namespace App\Livewire\Frontend;

use App\Models\KategoriMenu;
use App\Models\Menu;
use App\Models\Denah;
use App\Models\Meja;
use App\Models\Reservasi;
use App\Models\VariasiMenu;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class HalamanDepan extends Component
{
    // Data dari DB
    public $kategoriMenu;
    public $menuPopuler;
    public $semuaMenu;
    public $denah;
    public $meja;

    // State untuk UI & Interaksi
    public $kategoriAktif = 'semua';
    public bool $showTableSelection = false;

    // State untuk Pesanan
    public array $keranjang = [];
    public float $totalHarga = 0;
    public ?int $mejaTerpilihId = null;
    public ?string $tanggalReservasi;
    public ?string $waktuReservasi;

    /**
     * Dijalankan saat komponen pertama kali dimuat.
     */
    public function mount()
    {
        $this->kategoriMenu = KategoriMenu::all();
        $this->menuPopuler = Menu::with('variasiMenu')->where('tersedia', true)->inRandomOrder()->limit(4)->get();
        $this->semuaMenu = Menu::with('kategori', 'variasiMenu')->where('tersedia', true)->get();

        $this->denah = Denah::where('aktif', true)->first();
        if ($this->denah) {
            $this->meja = Meja::where('denah_id', $this->denah->id)->get();
        }

        $this->tanggalReservasi = now()->format('Y-m-d');
        $this->waktuReservasi = now()->addHour()->format('H:00');
        $this->loadCartFromSession();
    }

    /**
     * Memuat keranjang dari session saat komponen dimuat.
     */
    public function loadCartFromSession()
    {
        $this->keranjang = session('cart', []);
        $this->hitungTotal();
    }

    /**
     * Me-refresh status meja secara real-time.
     */
    public function refreshMejaStatus()
    {
        if ($this->denah) {
            $this->meja = Meja::where('denah_id', $this->denah->id)->get();
        }
    }

    /**
     * Memfilter menu berdasarkan kategori yang dipilih.
     */
    public function filterKategori($slug)
    {
        $this->kategoriAktif = $slug;
    }

    /**
     * Menambahkan item ke keranjang.
     */
    public function tambahKeKeranjang($variasiId)
    {
        $variasi = VariasiMenu::with('menu')->find($variasiId);
        if (!$variasi) return;

        if (isset($this->keranjang[$variasiId])) {
            $this->keranjang[$variasiId]['jumlah']++;
        } else {
            $this->keranjang[$variasiId] = [
                'variasi_id' => $variasi->id,
                'nama_menu' => $variasi->menu->nama,
                'nama_variasi' => $variasi->nama_variasi,
                'harga' => $variasi->harga,
                'jumlah' => 1,
            ];
        }
        $this->updateCart();
        $this->dispatch('show-toast', message: 'Menu ditambahkan ke keranjang!', type: 'success');
    }

    /**
     * Mengurangi item dari keranjang.
     */
    public function kurangiDariKeranjang($variasiId)
    {
        if (isset($this->keranjang[$variasiId])) {
            $this->keranjang[$variasiId]['jumlah']--;
            if ($this->keranjang[$variasiId]['jumlah'] <= 0) {
                unset($this->keranjang[$variasiId]);
            }
        }
        $this->updateCart();
    }

    /**
     * Menyimpan keranjang ke session dan menghitung ulang total.
     */
    public function updateCart()
    {
        session(['cart' => $this->keranjang]);
        $this->hitungTotal();
    }

    /**
     * Menghitung total harga dari item di keranjang.
     */
    public function hitungTotal()
    {
        $this->totalHarga = collect($this->keranjang)->sum(function ($item) {
            return $item['harga'] * $item['jumlah'];
        });
    }

    /**
     * Memilih atau membatalkan pilihan meja.
     */
    public function pilihMeja($mejaId)
    {
        $meja = Meja::find($mejaId);
        if ($meja && $meja->status === 'tersedia') {
            $this->mejaTerpilihId = $this->mejaTerpilihId === $mejaId ? null : $mejaId;
        }
    }

    /**
     * Menyimpan pesanan akhir ke database.
     */
    public function buatPesanan($withTable = false)
    {
        $userId = Auth::id();
        $kodeSuffix = $userId ?? Str::upper(Str::random(5));

        if (empty($this->keranjang) && $withTable == false) {
            $this->dispatch('show-toast', message: 'Keranjang Anda kosong.', type: 'danger');
            return;
        }

        if ($withTable && is_null($this->mejaTerpilihId)) {
            $this->dispatch('show-toast', message: 'Silakan pilih meja terlebih dahulu.', type: 'danger');
            return;
        }

        $reservasi = Reservasi::create([
            'user_id' => $userId,
            'meja_id' => $withTable ? $this->mejaTerpilihId : null,
            'kode_reservasi' => 'NK-' . now()->timestamp . '-' . $kodeSuffix,
            'tanggal_reservasi' => $this->tanggalReservasi,
            'waktu_reservasi' => $this->waktuReservasi,
            'jumlah_orang' => 1,
            'total_bayar' => $this->totalHarga,
            'metode_pembayaran' => 'e_wallet',
            'status_pembayaran' => 'pending',
            'tipe_pesanan' => $withTable ? 'makan_ditempat' : 'bawa_pulang',
            'status' => 'pending',
        ]);

        foreach ($this->keranjang as $item) {
            $reservasi->detailReservasi()->create([
                'variasi_menu_id' => $item['variasi_id'],
                'jumlah' => $item['jumlah'],
                'harga_saat_pesan' => $item['harga'],
            ]);
        }

        if ($withTable) {
            Meja::find($this->mejaTerpilihId)->update(['status' => 'dipesan']);
        }

        session()->forget('cart');
        $this->reset(['keranjang', 'mejaTerpilihId', 'totalHarga', 'showTableSelection']);

        $this->dispatch('order-success', message: 'Pesanan Anda berhasil dibuat! Silakan lanjutkan pembayaran di halaman akun Anda.');
    }

    public function render()
    {
        return view('livewire.frontend.halaman-depan')
            ->layout('components.layouts.app');
    }
}
