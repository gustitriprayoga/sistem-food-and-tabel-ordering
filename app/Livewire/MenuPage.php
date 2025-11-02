<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Denah;
use App\Models\KategoriMenu;
use App\Models\VariasiMenu;

class MenuPage extends Component
{
    public array $keranjang = [];
    public $selectedDenahId;
    public $selectedMejaId = null;
    public bool $showReservasiNotification = true;


    protected $listeners = ['mejaDipilih' => 'setSelectedMeja'];

    public function mount()
    {
        $firstDenah = Denah::where('aktif', true)->first();
        $this->selectedDenahId = $firstDenah->id ?? null;
    }

    public function setSelectedMeja($mejaId)
    {
        // Fungsi ini akan menerima ID meja dari komponen anak
        $this->selectedMejaId = $mejaId;
    }

    public function updateCart($variasiMenuId, $action = 'add')
    {
        $variasi = VariasiMenu::with('menu')->find($variasiMenuId);
        if (!$variasi || !$variasi->tersedia) {
            session()->flash('error', 'Menu tidak tersedia.');
            return;
        }

        $namaLengkap = $variasi->menu->nama . ' (' . $variasi->nama_variasi . ')';
        $harga = $variasi->harga;

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

    public function dismissReservasiNotification()
    {
        $this->showReservasiNotification = false;
    }

    public function getTotalProperty()
    {
        return array_sum(array_map(fn($item) => $item['harga'] * $item['jumlah'], $this->keranjang));
    }

    public function checkout()
    {
        if (empty($this->keranjang)) {
            session()->flash('error', 'Keranjang Anda kosong!');
            return;
        }

        session()->put('order_data', [
            'type' => 'menu',
            'cart' => $this->keranjang,
            'meja_id' => $this->selectedMejaId,
        ]);

        return redirect()->route('pembayaran.index');
    }

    public function render()
    {
        $kategoriMenus = KategoriMenu::with(['menus.variasiMenus' => function ($query) {
            $query->where('tersedia', true);
        }])->get();

        return view('livewire.menu-page', [
            'kategoriMenus' => $kategoriMenus,
            'denahs' => Denah::where('aktif', true)->get(),
        ])->layout('components.layouts.app', ['title' => 'Pesan Menu']);
    }
}
