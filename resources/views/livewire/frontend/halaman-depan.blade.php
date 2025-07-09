{{-- File: resources/views/livewire/frontend/halaman-depan.blade.php --}}
<div>
    <main>
        <!-- Hero Section -->
        <section class="d-flex align-items-center text-center text-white vh-100 position-relative overflow-hidden">
            <style>
                .hero-bg-video { position: absolute; top: 50%; left: 50%; min-width: 100%; min-height: 100%; width: auto; height: auto; z-index: -1; transform: translateX(-50%) translateY(-50%); }
                .hero-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(17, 17, 17, 0.6); }
            </style>
            <video playsinline autoplay muted loop poster="https://images.unsplash.com/photo-1511920183353-3c7c95a5742c?q=80&w=1887" class="hero-bg-video">
                <source src="https://videos.pexels.com/video-files/3209828/3209828-hd_1920_1080_25fps.mp4" type="video/mp4">
            </video>
            <div class="hero-overlay"></div>
            <div class="container position-relative reveal">
                <h1 class="display-1 ff-serif fw-bold">Seni dalam Secangkir Kopi</h1>
                <p class="lead fs-4 my-4 mx-auto" style="max-width: 700px;">Rasakan kehangatan suasana dan kekayaan rasa yang kami sajikan di setiap sudut Niskala Kafe.</p>
                <a href="#" class="btn btn-accent btn-lg mt-3">
                    Jelajahi Menu & Pesan
                </a>
            </div>
        </section>

        <!-- Keunggulan Section -->
        <section id="keunggulan" class="py-5 bg-secondary">
            <div class="container py-5">
                <div class="text-center mb-5 reveal">
                    <h2 class="display-5 ff-serif fw-bold">Pengalaman yang Kami Tawarkan</h2>
                    <p class="text-muted">Tiga pilar yang menjadikan kami lebih dari sekadar tempat minum kopi.</p>
                </div>
                <div class="row g-4 text-center">
                    @foreach($keunggulan as $index => $item)
                        <div class="col-lg-4 reveal" style="transition-delay: {{ $index * 200 }}ms">
                            <div class="custom-card p-4 p-lg-5 h-100">
                                <div class="icon-container d-inline-block bg-dark p-4 rounded-circle mb-4">
                                    @svg($item['icon'], 'text-accent' ,['style' => 'width: 48px; height: 48px;'])
                                </div>
                                <h4 class="ff-serif fs-4 mb-3">{{ $item['judul'] }}</h4>
                                <p class="text-muted">{{ $item['deskripsi'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Menu Populer Section -->
        <section id="menu" class="py-5">
            <div class="container py-5">
                <div class="text-center mb-5 reveal">
                    <h2 class="display-5 ff-serif fw-bold">Pilihan Terpopuler</h2>
                    <p class="text-muted">Menu yang selalu berhasil mencuri hati para pelanggan setia kami.</p>
                </div>
                <div class="row g-4">
                    @foreach($menuPopuler as $item)
                        <div class="col-lg-4 col-md-6 reveal">
                            <div class="card custom-card h-100 overflow-hidden">
                                <div class="overflow-hidden">
                                    @php
                                        $imagePath = ($item->gambar && Storage::disk('public')->exists($item->gambar))
                                                     ? Storage::url($item->gambar)
                                                     : asset('images/default/default-menu.jpg');
                                    @endphp
                                    <img src="{{ $imagePath }}" class="card-img-top" alt="{{ $item->nama }}" style="height: 280px; object-fit: cover; transition: transform 0.5s ease;">
                                </div>
                                <div class="card-body d-flex flex-column p-4">
                                    <h5 class="card-title ff-serif fs-4 flex-grow-1">{{ $item->nama }}</h5>
                                    <p class="card-text text-muted mb-3">
                                        Mulai dari <span class="fw-bold text-light">Rp {{ number_format($item->variasiMenu->min('harga')) }}</span>
                                    </p>
                                    <a href="#" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-5 reveal">
                    <a href="#" class="btn btn-accent">
                        Lihat Semua Menu
                    </a>
                </div>
            </div>
        </section>
    </main>
</div>
