<div class="home-page-container">

    <section class="min-vh-80 d-flex align-items-center justify-content-center text-center p-5 position-relative"
        style="background: url('path/to/your/cafe_interior_light.jpg') no-repeat center center; background-size: cover;">

        {{-- KOREKSI: Tambahkan padding top (misalnya pt-5) pada container hero atau div z-1 --}}

        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(255, 255, 255, 0.4);">
        </div>

        <div class="container position-relative z-1 py-5 pt-6">
            <h1 class="ff-serif display-1 fw-bold mb-4 text-dark" style="letter-spacing: 2px;">
                Ciptakan Momen di <span class="text-accent">Niskala</span>
            </h1>
            <p class="lead mb-5 text-dark opacity-75">
                Reservasi meja Anda, jelajahi menu kami, dan nikmati suasana yang autentik.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('booking.start') }}" class="btn btn-accent btn-lg shadow">
                    Mulai Booking Sekarang!
                </a>
                <a href="#menu-slider" class="btn btn-outline-dark btn-lg shadow" style="border-radius: 50px;">
                    Lihat Menu &darr;
                </a>
            </div>
        </div>
    </section>

    <section id="layanan" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="ff-serif display-5 fw-bold text-dark mb-3">Layanan Eksklusif Kami</h2>
            </div>

            <div class="row g-4 justify-content-center">

                {{-- Layanan 1 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="custom-card p-4 text-center border-accent h-100">
                        <div class="display-5 mb-3 text-accent">🍽️</div>
                        <h3 class="ff-serif text-light mb-3">Reservasi Meja Cepat</h3>
                        <p class="text-muted">Pilih lokasi meja Anda secara visual dan amankan tempat duduk dalam
                            hitungan menit.</p>
                    </div>
                </div>

                {{-- Layanan 2 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="custom-card p-4 text-center border-accent h-100">
                        <div class="display-5 mb-3 text-accent">☕</div>
                        <h3 class="ff-serif text-light mb-3">Menu Pre-Order</h3>
                        <p class="text-muted">Pesan menu saat Anda *booking* agar hidangan siap tersaji begitu Anda
                            tiba.</p>
                    </div>
                </div>

                {{-- Layanan 3 --}}
                <div class="col-lg-4 col-md-6">
                    <div class="custom-card p-4 text-center border-accent h-100">
                        <div class="display-5 mb-3 text-accent">✨</div>
                        <h3 class="ff-serif text-light mb-3">Suasana Nyaman</h3>
                        <p class="text-muted">Desain interior yang hangat dan *cozy*, ideal untuk bekerja atau
                            bersantai.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container my-5">
        <hr class="border-secondary opacity-50">
    </div>

    <section id="menu-slider" class="py-5" style="background-color: var(--bg-secondary-light) !important;">
        <div class="container text-center">
            <h2 class="ff-serif display-5 fw-bold text-dark mb-5">Pilihan Favorit Kami</h2>

            {{-- Carousel Container --}}
            <div id="menuCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">

                    @forelse ($featuredMenus as $index => $menu)
                        @php
                            // Ambil harga terendah dari variasi yang tersedia
                            $hargaTerendah = $menu->variasiMenus->min('harga');
                            // Ambil nama variasi (jika hanya ada satu) atau tampilkan 'Varian'
                            $namaVariasi =
                                $menu->variasiMenus->count() === 1
                                    ? $menu->variasiMenus->first()->nama_variasi
                                    : 'Varian';
                        @endphp

                        {{-- Item Slider --}}
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row justify-content-center">
                                <div class="col-md-4 col-sm-6 mb-4">
                                    {{-- KOREKSI: custom-card sebagai tampilan slider item --}}
                                    <div class="custom-card p-4 text-center border-accent h-100"
                                        style="background-color: #f8f8f8; color: var(--text-dark); border-color: var(--border-color-light);">

                                        {{-- Gambar Menu --}}
                                        @if ($menu->gambar)
                                            <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}"
                                                class="d-block w-75 mx-auto rounded-lg shadow-sm mb-3"
                                                style="max-height: 180px; object-fit: cover;">
                                        @else
                                            {{-- Placeholder yang menarik dengan visual dan branding --}}
                                            <div class="product-placeholder w-75 mx-auto rounded-lg shadow-sm mb-3"
                                                style="height: 180px; position: relative; overflow: hidden;">

                                                {{-- Visual (Opacity rendah agar teks branding menonjol) --}}
                                                <div
                                                    style="background: url('{{ asset('images/default/default-menu.jpg') }}') no-repeat center center;
                    background-size: 80%;
                    opacity: 0.2;
                    position: absolute; inset: 0;">
                                                </div>

                                                {{-- Branding Teks di Tengah --}}
                                                <div style="position: relative; z-index: 1;">
                                                    <strong class="text-accent ff-serif"
                                                        style="font-size: 1.5rem; letter-spacing: 2px;">NISKALA</strong>
                                                    <p class="text-light small m-0 mt-1">Cafe Product</p>
                                                </div>
                                            </div>
                                        @endif

                                        <h4 class="ff-serif text-dark mb-1">{{ $menu->nama }}</h4>

                                        @if ($hargaTerendah)
                                            <p class="h6 text-muted mb-3">{{ $namaVariasi }} |
                                                <span class="fw-bold text-accent">Rp
                                                    {{ number_format($hargaTerendah, 0, ',', '.') }}</span>
                                            </p>
                                        @endif

                                        {{-- Tombol Aksi --}}
                                        <a href="{{ route('booking.start') }}" class="btn btn-sm btn-outline-dark"
                                            style="border-radius: 50px;">
                                            Pesan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="carousel-item active">
                            <div class="custom-card p-5" style="background-color: var(--bg-dark);">
                                <h3 class="text-muted ff-serif text-light">Menu Favorit Belum Tersedia</h3>
                            </div>
                        </div>
                    @endforelse

                </div>

                {{-- Kontrol Carousel (Previous/Next) --}}
                <button class="carousel-control-prev" type="button" data-bs-target="#menuCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#menuCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>


    <section class="py-5 bg-dark">
        <div class="container text-center">
            <h2 class="ff-serif text-accent mb-3">Siap Membuat Reservasi?</h2>
            <p class="lead text-light mb-4">Semua yang Anda butuhkan dalam satu proses booking yang cepat dan mudah.</p>
            <a href="{{ route('booking.start') }}" class="btn btn-accent btn-lg shadow">
                Mulai Booking
            </a>
        </div>
    </section>
</div>
