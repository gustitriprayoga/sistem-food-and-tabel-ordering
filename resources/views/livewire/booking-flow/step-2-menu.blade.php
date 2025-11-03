<div class="row g-4">
    <div class="col-lg-8">
        <h3 class="text-light mb-4 ff-serif text-accent">Langkah 2: Pilih Menu</h3>
        <p class="text-muted mb-4">Pilih makanan dan minuman yang ingin Anda pesan sekarang (Pre-Order).</p>

        @if (($kategoriMenus ?? collect())->isEmpty())
            <p class="text-warning">Maaf, daftar menu belum tersedia.</p>
        @else
            <div class="space-y-6">
                @foreach ($kategoriMenus as $kategori)
                    <div class="custom-card p-4">
                        <h4 class="text-light mb-3 border-bottom border-secondary pb-2">{{ $kategori->nama }}</h4>
                        <div class="row g-3">
                            @forelse (($kategori->menus ?? collect()) as $menu)
                                @foreach ($menu->variasiMenus ?? collect() as $variasi)
                                    <div class="col-md-6">
                                        <div
                                            class="d-flex align-items-center bg-dark p-3 rounded shadow-sm border border-secondary">
                                            <div class="flex-grow-1">
                                                <p class="text-light mb-0">{{ $menu->nama }} <span
                                                        class="text-muted small">({{ $variasi->nama_variasi }})</span>
                                                </p>
                                                <p class="text-accent fw-bold small mb-0">Rp
                                                    {{ number_format($variasi->harga, 0, ',', '.') }}</p>
                                            </div>

                                            <div class="d-flex align-items-center ms-3">
                                                @php
                                                    $currentQty = $keranjang[$variasi->id]['jumlah'] ?? 0;
                                                @endphp

                                                <button wire:click="updateCart({{ $variasi->id }}, 'remove')"
                                                    class="btn btn-sm btn-outline-light"
                                                    {{ $currentQty <= 0 ? 'disabled' : '' }}>-</button>

                                                <span class="text-light mx-2">{{ $currentQty }}</span>

                                                <button wire:click="updateCart({{ $variasi->id }}, 'add')"
                                                    class="btn btn-sm btn-accent text-dark">+</button>
                                            </div>
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
        @endif
    </div>

    {{-- Ringkasan Keranjang di Samping --}}
    <div class="col-lg-4">
        <div class="custom-card p-4 sticky-top" style="top: 100px;">
            <h5 class="text-light mb-3 border-bottom border-secondary pb-2">Keranjang Anda</h5>

            @if (empty($keranjang ?? []))
                <p class="text-muted text-center py-3">Keranjang kosong. Pilih menu di samping!</p>
            @else
                <ul class="list-unstyled mb-4 max-h-60 overflow-y-auto">
                    @foreach ($keranjang as $id => $item)
                        <li class="d-flex justify-content-between small border-bottom border-secondary py-1">
                            <span class="text-light">{{ $item['nama'] }}</span>
                            <span class="text-accent fw-bold">{{ $item['jumlah'] }}x</span>
                        </li>
                    @endforeach
                </ul>
                <div class="d-flex justify-content-between h6 text-light mt-3">
                    <span>Total Menu:</span>
                    <span class="text-accent">Rp {{ number_format($this->totalMenu, 0, ',', '.') }}</span>
                </div>
            @endif
        </div>
    </div>
</div>
