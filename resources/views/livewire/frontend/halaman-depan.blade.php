{{-- File: resources/views/livewire/frontend/halaman-depan.blade.php --}}
<div x-data="{
    showCart: false,
    showTableConfirm: false,
    showTableSelection: @entangle('showTableSelection')
}"
    @keydown.escape.window="showCart = false; showTableConfirm = false; showTableSelection = false">

    <!-- Tombol Keranjang Melayang -->
    <div class="fixed bottom-8 right-8 z-50">
        <button @click="showCart = true"
            class="relative bg-accent text-gray-900 w-16 h-16 rounded-full shadow-lg flex items-center justify-center transform hover:scale-110 transition-transform">
            @svg('heroicon-o-shopping-bag', 'w-8 h-8')
            @if (count($keranjang) > 0)
                <span
                    class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full h-6 w-6 flex items-center justify-center border-2 border-gray-900">
                    {{ count($keranjang) }}
                </span>
            @endif
        </button>
    </div>

    <!-- Modal Keranjang Belanja -->
    <div x-show="showCart" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center" x-cloak>
        <div @click.away="showCart = false"
            class="bg-gray-900 border border-gray-800 rounded-2xl shadow-xl w-full max-w-md m-4 max-h-[90vh] flex flex-col">
            <div class="p-6 border-b border-gray-800">
                <h3 class="text-xl font-bold font-serif text-white">Keranjang Anda</h3>
            </div>
            <div class="p-6 space-y-4 overflow-y-auto flex-grow">
                @forelse($keranjang as $item)
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-white">{{ $item['nama_menu'] }} <span
                                    class="text-gray-400">({{ $item['nama_variasi'] }})</span></p>
                            <p class="text-gray-400">Rp {{ number_format($item['harga']) }}</p>
                        </div>
                        <div class="flex items-center gap-3 bg-gray-800 rounded-full p-1">
                            <button wire:click="kurangiDariKeranjang({{ $item['variasi_id'] }})"
                                class="w-6 h-6 rounded-full hover:bg-gray-700">-</button>
                            <span class="font-mono text-white">{{ $item['jumlah'] }}</span>
                            <button wire:click="tambahKeKeranjang({{ $item['variasi_id'] }})"
                                class="w-6 h-6 rounded-full hover:bg-gray-700">+</button>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-8">Keranjang Anda masih kosong.</p>
                @endforelse
            </div>
            @if (count($keranjang) > 0)
                <div class="p-6 border-t border-gray-800">
                    <div class="flex justify-between font-bold text-lg text-white">
                        <span>Total</span>
                        <span class="text-accent">Rp {{ number_format($totalHarga) }}</span>
                    </div>
                    <button @click="showCart = false; showTableConfirm = true"
                        class="w-full mt-4 bg-accent text-gray-900 font-bold py-3 rounded-lg hover:bg-amber-400 transition-all">
                        Lanjutkan
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Konfirmasi Meja -->
    <div x-show="showTableConfirm" x-transition
        class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center" x-cloak>
        <div @click.away="showTableConfirm = false"
            class="bg-gray-900 border border-gray-800 rounded-2xl shadow-xl w-full max-w-lg m-4 p-8 text-center">
            <h3 class="text-2xl font-bold font-serif text-white">Reservasi Meja?</h3>
            <p class="text-gray-400 mt-2 mb-6">Apakah Anda ingin memesan meja untuk menikmati pesanan ini di tempat?</p>
            <div class="flex justify-center gap-4">
                <button wire:click="buatPesanan(false)" @click="showTableConfirm = false"
                    class="bg-gray-700 text-white font-bold py-3 px-6 rounded-lg hover:bg-gray-600 transition">Tidak,
                    Bawa Pulang</button>
                <button @click="showTableConfirm = false; showTableSelection = true"
                    class="bg-accent text-gray-900 font-bold py-3 px-6 rounded-lg hover:bg-amber-400 transition">Ya,
                    Pilih Meja</button>
            </div>
        </div>
    </div>

    <main>
        <!-- 1. Banner Section -->
        <section class="relative h-[80vh] flex items-center text-white overflow-hidden">
            <div class="absolute inset-0 bg-black/60 z-10"></div>
            <video playsinline autoplay muted loop class="absolute inset-0 w-full h-full object-cover z-0">
                <source src="https://videos.pexels.com/video-files/3209828/3209828-hd_1920_1080_25fps.mp4"
                    type="video/mp4">
            </video>
            <div class="relative z-20 container mx-auto px-6 text-center reveal">
                <h1 class="text-5xl md:text-8xl font-bold font-serif">Seni dalam Secangkir Kopi</h1>
                <p class="text-xl text-gray-300 mt-4 max-w-2xl mx-auto">Rasakan kehangatan suasana dan kekayaan rasa
                    yang kami sajikan di setiap sudut Niskala Kafe.</p>
            </div>
        </section>

        <!-- 2. Kategori Menu Section -->
        <section class="py-16 bg-gray-950">
            <div class="container mx-auto px-6 text-center reveal">
                <h2 class="text-3xl font-bold font-serif text-white mb-8">Jelajahi Kategori</h2>
                <div class="flex justify-center flex-wrap gap-4 md:gap-8">
                    <a href="#menu" wire:click.prevent="filterKategori('semua')"
                        class="flex flex-col items-center space-y-2 group">
                        <div
                            class="{{ $kategoriAktif === 'semua' ? 'bg-accent text-gray-900' : 'bg-gray-800 text-gray-300 group-hover:bg-accent group-hover:text-gray-900' }} w-20 h-20 rounded-full flex items-center justify-center transition-all duration-300">
                            @svg('heroicon-o-squares-2x2', 'w-8 h-8')
                        </div>
                        <span class="font-medium text-sm">Semua</span>
                    </a>
                    @foreach ($kategoriMenu as $kategori)
                        <a href="#menu" wire:click.prevent="filterKategori('{{ $kategori->slug }}')"
                            class="flex flex-col items-center space-y-2 group">
                            <div
                                class="{{ $kategoriAktif === $kategori->slug ? 'bg-accent text-gray-900' : 'bg-gray-800 text-gray-300 group-hover:bg-accent group-hover:text-gray-900' }} w-20 h-20 rounded-full flex items-center justify-center transition-all duration-300">
                                @svg('heroicon-o-squares-2x2', 'w-8 h-8')
                            </div>
                            <span class="font-medium text-sm">{{ $kategori->nama }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- 3. Produk Terlaris Section -->
        <section class="py-16">
            <div class="container mx-auto px-6 reveal">
                <h2 class="text-3xl font-bold font-serif text-white text-center mb-8">Pilihan Terpopuler</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($menuPopuler as $item)
                        <div class="bg-gray-900/50 border border-gray-800 rounded-2xl overflow-hidden group">
                            <div class="h-56 overflow-hidden">
                                <img src="{{ $item->gambar && Storage::disk('public')->exists($item->gambar) ? Storage::url($item->gambar) : asset('images/default/default-menu.jpg') }}"
                                    alt="{{ $item->nama }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-white">{{ $item->nama }}</h3>
                                <p class="text-gray-400 text-sm">Mulai dari Rp
                                    {{ number_format($item->variasiMenu->min('harga')) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- 4. Semua Menu Section -->
        <section id="menu" class="py-16 bg-gray-950">
            <div class="container mx-auto px-6 reveal">
                <h2 class="text-3xl font-bold font-serif text-white text-center mb-8">Menu Lengkap Kami</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($semuaMenu as $item)
                        @if ($kategoriAktif === 'semua' || $kategoriAktif === $item->kategori->slug)
                            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-4 flex flex-col">
                                <h3 class="font-bold text-lg text-white mb-2">{{ $item->nama }}</h3>
                                <p class="text-gray-400 text-sm mb-4 flex-grow">{{ $item->deskripsi }}</p>
                                <div class="space-y-2">
                                    @foreach ($item->variasiMenu as $variasi)
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <span class="text-gray-300">{{ $variasi->nama_variasi }}</span>
                                                <p class="font-semibold text-accent">Rp
                                                    {{ number_format($variasi->harga) }}</p>
                                            </div>
                                            <button wire:click="tambahKeKeranjang({{ $variasi->id }})"
                                                class="bg-gray-800 text-accent w-10 h-10 rounded-full hover:bg-accent hover:text-gray-900 transition">+</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        <!-- 5. Tampilan Meja & Denah -->
        <section id="denah" x-show="showTableSelection" x-transition
            class="fixed inset-0 bg-gray-950 z-40 overflow-y-auto p-8" x-cloak>
            <div class="container mx-auto reveal">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold font-serif text-white">Pilih Meja Anda</h2>
                    <button @click="showTableSelection = false" class="text-gray-400 hover:text-white">&times;
                        Tutup</button>
                </div>
                @if ($denah)
                    <div wire:poll.15s="refreshMejaStatus" class="border border-gray-800 p-4 rounded-2xl relative"
                        style="background-image: url('{{ Storage::url($denah->path_gambar) }}'); background-size: cover; background-position: center; min-height: 70vh;">
                        <div class="absolute inset-0 bg-black/60 rounded-2xl"></div>
                        @foreach ($meja as $m)
                            <div wire:click="pilihMeja({{ $m->id }})"
                                class="absolute flex items-center justify-center font-bold text-sm text-white rounded-lg shadow-xl cursor-pointer transition-all duration-300 border-2"
                                style="width: 80px; height: 60px; left: {{ $m->posisi_x }}px; top: {{ $m->posisi_y }}px; border-color: {{ $mejaTerpilihId == $m->id ? 'var(--accent-color)' : 'transparent' }}; transform: {{ $mejaTerpilihId == $m->id ? 'scale(1.1)' : 'scale(1)' }}; background-color: {{ $m->status === 'tersedia' ? 'rgba(34, 197, 94, 0.7)' : 'rgba(239, 68, 68, 0.6)' }}; pointer-events: {{ $m->status === 'tersedia' ? 'auto' : 'none' }};">
                                {{ $m->nama }}
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-8">
                        <button wire:click="buatPesanan(true)"
                            class="bg-accent text-gray-900 font-bold py-3 px-8 rounded-lg"
                            :disabled="{{ $mejaTerpilihId ? 'false' : 'true' }}">
                            Konfirmasi Meja & Pesan
                        </button>
                    </div>
                @else
                    <p class="text-center text-gray-500">Denah tidak tersedia.</p>
                @endif
            </div>
        </section>
    </main>
</div>
