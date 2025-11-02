<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Meja;
use App\Models\Denah;
use App\Models\KategoriMenu;
use App\Models\VariasiMenu;
use App\Models\Reservasi;
use App\Models\DetailReservasi;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BookingFlow extends Component
{
    // --- STEP STATE ---
    public $step = 1;

    // --- DATA STATE ---
    public $tanggal_reservasi;
    public $waktu_reservasi;
    public $jumlah_orang;
    public array $keranjang = [];
    public $selectedDenahId;
    public $selectedMejaId = null;
    public $hanyaPesanMeja = false;
    public $metode_pembayaran;
    public $catatan;
    public $kodeReservasi;
    public $reservasiBerhasil = false;

    // Data yang dimuat
    public $kategoriMenus = [];

    protected $listeners = ['mejaDipilih' => 'setSelectedMeja'];

    // --- VALIDATION RULES ---
    protected function getValidationRules()
    {
        return match ($this->step) {
            1 => [
                'tanggal_reservasi' => 'required|date|after_or_equal:today',
                'waktu_reservasi' => 'required|date_format:H:i',
                'jumlah_orang' => 'required|integer|min:1',
            ],
            3 => [
                // Kita akan mengecek keberadaan selectedMejaId secara manual di nextStep jika hanyaPesanMeja=true
            ],
            5 => [
                'metode_pembayaran' => 'required|in:kasir,transfer_bank,e_wallet',
            ],
            default => []
        };
    }

    public function mount()
    {
        $this->tanggal_reservasi = now()->toDateString();
        $this->waktu_reservasi = now()->addHour()->format('H:i');
        $this->jumlah_orang = 2;

        $firstDenah = Denah::where('aktif', true)->first();
        $this->selectedDenahId = $firstDenah->id ?? null;

        $this->loadMenuData();
    }

    private function loadMenuData()
    {
        $this->kategoriMenus = KategoriMenu::with(['menus.variasiMenus' => function ($query) {
            $query->where('tersedia', true);
        }])->get();
    }

    public function setSelectedMeja($mejaId)
    {
        $this->selectedMejaId = $mejaId;
    }

    // --- LOGIKA CART LENGKAP ---
    public function updateCart($variasiMenuId, $action = 'add')
    {
        $variasi = VariasiMenu::with('menu')->find($variasiMenuId);
        if (!$variasi || !$variasi->tersedia) {
            session()->flash('error', 'Menu tidak tersedia.');
            return;
        }

        $namaLengkap = $variasi->menu->nama . ' (' . $variasi->nama_variasi . ')';
        $harga = $variasi->harga;

        // Inisialisasi item jika belum ada
        if (!isset($this->keranjang[$variasiMenuId])) {
            $this->keranjang[$variasiMenuId] = [
                'nama' => $namaLengkap,
                'harga' => $harga,
                'jumlah' => 0,
                'menu_id' => $variasi->menu_id
            ];
        }

        if ($action === 'add') {
            $this->keranjang[$variasiMenuId]['jumlah']++;
        } elseif ($action === 'remove') {
            $this->keranjang[$variasiMenuId]['jumlah']--;
            if ($this->keranjang[$variasiMenuId]['jumlah'] <= 0) {
                unset($this->keranjang[$variasiMenuId]);
            }
        }
    }

    // --- COMPUTED PROPERTIES LENGKAP & KOREKSI NULL ARRAY ---
    public function getTotalMenuProperty()
    {
        // KOREKSI: Menggunakan operator ?? untuk mencegah error jika $keranjang null
        $keranjangData = $this->keranjang ?? [];
        return array_sum(array_map(fn($item) => $item['harga'] * $item['jumlah'], $keranjangData));
    }

    public function getTotalDPProperty()
    {
        // Asumsi DP tetap 50k
        return 50000;
    }

    public function getTotalBayarProperty()
    {
        return $this->getTotalMenuProperty() + $this->getTotalDPProperty();
    }

    // --- FLOW MANAGEMENT ---
    public function nextStep()
    {
        try {
            // Lakukan validasi sesuai langkah saat ini
            $this->validate($this->getValidationRules());
        } catch (ValidationException $e) {
            session()->flash('error', 'Terdapat kesalahan input: ' . $e->getMessage());
            return;
        }


        if ($this->step === 1) {
            $this->step = 2;
        } elseif ($this->step === 2) {
            // Logika: Jika tidak pesan menu, aktifkan flag hanyaPesanMeja
            $this->hanyaPesanMeja = empty($this->keranjang);
            $this->step = 3;
        } elseif ($this->step === 3) {
            // Validasi manual untuk Step 3 (Meja)
            if (!empty($this->keranjang) || $this->hanyaPesanMeja) {
                if (is_null($this->selectedMejaId)) {
                    session()->flash('error', 'Anda wajib memilih meja untuk melanjutkan.');
                    return;
                }
            }
            $this->step = 4;
        } elseif ($this->step === 4) {
            // Cek apakah ada yang dipesan (menu atau meja) sebelum lanjut
            if (empty($this->keranjang) && is_null($this->selectedMejaId)) {
                session()->flash('error', 'Anda harus memilih meja DAN/ATAU memesan menu.');
                return;
            }
            $this->step = 5;
        } elseif ($this->step === 5) {
            $this->saveOrder();
            $this->step = 6;
        }

        session()->forget('error'); // Bersihkan pesan error jika berhasil next step
    }

    public function prevStep()
    {
        $this->step = max(1, $this->step - 1);
        session()->forget('error'); // Bersihkan pesan error saat kembali
    }

    // --- LOGIKA SAVE ORDER LENGKAP ---
    public function saveOrder()
    {
        $this->kodeReservasi = 'NKL-' . strtoupper(Str::random(6));
        $totalBayarAkhir = $this->getTotalBayarProperty();
        $tipePesanan = empty($this->keranjang) ? 'makan_ditempat' : 'pre_order';
        $statusPembayaran = ($this->metode_pembayaran == 'kasir') ? 'pending' : 'menunggu_konfirmasi';

        // 2. SIMPAN RESERVASI UTAMA
        $reservasi = Reservasi::create([
            'kode_reservasi' => $this->kodeReservasi,
            'meja_id' => $this->selectedMejaId,
            'tanggal_reservasi' => $this->tanggal_reservasi,
            'waktu_reservasi' => $this->waktu_reservasi,
            'jumlah_orang' => $this->jumlah_orang,
            'catatan' => $this->catatan,
            'total_bayar' => $totalBayarAkhir,
            'metode_pembayaran' => $this->metode_pembayaran,
            'status_pembayaran' => $statusPembayaran,
            'tipe_pesanan' => $tipePesanan,
            'status' => 'pending',
        ]);

        // 3. SIMPAN DETAIL MENU (JIKA ADA)
        if (!empty($this->keranjang)) {
            foreach ($this->keranjang as $variasi_id => $item) {
                // Pastikan Anda menggunakan Model DetailReservasi yang sesuai
                DetailReservasi::create([
                    'reservasi_id' => $reservasi->id,
                    'variasi_menu_id' => $variasi_id,
                    'jumlah' => $item['jumlah'],
                    'harga_saat_pesan' => $item['harga'],
                ]);
            }
        }

        // 4. UPDATE STATUS MEJA (Jika Meja dipilih)
        if ($this->selectedMejaId) {
            $meja = Meja::find($this->selectedMejaId);
            if ($meja) {
                // Meja diubah statusnya menjadi 'dipesan' setelah konfirmasi/pembayaran
                $meja->status = 'dipesan';
                $meja->save();
            }
        }

        $this->reservasiBerhasil = true;
    }

    public function render()
    {
        return view('livewire.booking-flow')
            ->layout('components.layouts.app', ['title' => 'Booking - Langkah ' . $this->step]);
    }
}
