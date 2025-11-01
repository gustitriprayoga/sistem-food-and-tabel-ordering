<div class="container py-5 reveal">
    <h1 class="ff-serif display-5 fw-bold text-light mb-5 text-center">Menu Kami</h1>

    <div class="row g-4">

        <div class="col-lg-8">

            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
            @endif

            @if ($showReservasiNotification)
                <div
                    class="alert custom-card p-4 mb-4 d-flex justify-content-between align-items-center bg-warning bg-opacity-10 border-start border-warning border-5">
                    <div>
                        <h5 class="mb-1 text-accent">Mau Reservasi Meja?</h5>
                        <p class="mb-0 text-muted small">Untuk menjadwalkan kunjungan di masa depan, silakan <a
                                href="{{ route('reservasi.index') }}" class="text-accent fw-bold">buat reservasi
                                terjadwal</a>.</p>
                    </div>
                    <button wire:click="dismissReservasiNotification" type="button" class="btn-close btn-close-white"
                        aria-label="Close"></button>
                </div>
            @endif

            <div class="custom-card p-4 mb-4">
                <h4 class="text-light mb-3 border-bottom border-secondary pb-2">Pilih Meja (Dine-in Walk-in)</h4>
                @if ($selectedDenahId)
                    <div class="d-flex gap-2 mb-3 overflow-x-auto pb-2">
                        @foreach ($denahs as $denah)
                            <button wire:click="$set('selectedDenahId', {{ $denah->id }})"
                                class="btn btn-sm btn-{{ $selectedDenahId == $denah->id ? 'accent text-dark' : 'outline-light' }}"
                                style="border-radius: 50px;">
                                {{ $denah->nama }}
                            </button>
                        @endforeach
                    </div>

                    @livewire('denah-meja-selector', ['denahId' => $selectedDenahId, 'selectedMejaId' => $selectedMejaId], key('denah-' . $selectedDenahId))
                @else
                    <p class="text-muted">Tidak ada denah aktif yang ditemukan.</p>
                @endif

                @if ($selectedMejaId)
                    <p class="mt-3 text-success fw-bold">Meja Terpilih:
                        {{ \App\Models\Meja::find($selectedMejaId)->nama ?? 'Meja tidak valid' }}</p>
                @endif
            </div>

            <div class="custom-card p-4">
                <h3 class="ff-serif text-light mb-4 border-bottom border-secondary pb-2">Semua Menu</h3>
                @foreach ($kategoriMenus as $kategori)
                    <div id="kategori-{{ $kategori->slug }}" class="mb-5">
                        <h4 class="text-accent mb-3">{{ $kategori->nama }}</h4>
                        <div class="row g-4">
                            @forelse ($kategori->menus as $menu)
                                @foreach ($menu->variasiMenus as $variasi)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center custom-card p-3 shadow-sm border-0">
                                            <div class="flex-grow-1">
                                                <h5 class="text-light mb-0">{{ $menu->nama }} <span
                                                        class="text-muted small">({{ $variasi->nama_variasi }})</span>
                                                </h5>
                                                <p class="text-accent fw-bold mb-1">Rp
                                                    {{ number_format($variasi->harga, 0, ',', '.') }}</p>
                                                <p class="text-muted small mb-0">{{ Str::limit($menu->deskripsi, 50) }}
                                                </p>
                                            </div>
                                            <button wire:click="updateCart({{ $variasi->id }}, 'add')"
                                                class="btn btn-accent btn-sm ms-3">
                                                + Tambah
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @empty
                                <p class="text-muted col-12">Tidak ada menu yang tersedia di kategori ini.</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-lg-4">
            <div class="custom-card p-4 sticky-top" style="top: 100px;">
                <h4 class="text-light mb-4 border-bottom border-secondary pb-2">🛒 Keranjang Pesanan</h4>

                @if (empty($keranjang))
                    <p class="text-muted text-center py-5">Keranjang Anda kosong.</p>
                @else
                    <ul class="list-unstyled space-y-3 mb-4 max-h-96 overflow-y-auto">
                        @foreach ($keranjang as $id => $item)
                            <li
                                class="d-flex justify-content-between align-items-center border-bottom border-secondary pb-2 mb-2">
                                <div class="flex-grow-1">
                                    <p class="font-medium text-light mb-0">{{ $item['nama'] }}</p>
                                    <p class="text-muted small mb-0">Rp
                                        {{ number_format($item['harga'], 0, ',', '.') }}</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button wire:click="updateCart({{ $id }}, 'remove')"
                                        class="btn btn-sm btn-outline-light me-1">-</button>
                                    <span class="text-light mx-2">{{ $item['jumlah'] }}</span>
                                    <button wire:click="updateCart({{ $id }}, 'add')"
                                        class="btn btn-sm btn-outline-light me-3">+</button>
                                </div>
                                <span class="text-accent fw-bold ms-3">Rp
                                    {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="pt-4 border-top border-secondary">
                        <div class="d-flex justify-content-between font-bold h5 text-light mb-4">
                            <span>TOTAL:</span>
                            <span class="text-accent">Rp {{ number_format($this->total, 0, ',', '.') }}</span>
                        </div>

                        <button wire:click="checkout" class="btn btn-accent btn-lg w-100 shadow">
                            Lanjut ke Pembayaran
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
