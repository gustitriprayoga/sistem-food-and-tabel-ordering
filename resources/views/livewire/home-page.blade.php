<div class="home-page-container">

    <section class="min-vh-100 d-flex align-items-center justify-content-center text-center p-5 position-relative"
        style="background: url('path/to/your/coffee_bg_dark.jpg') no-repeat center center; background-size: cover;">

        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.65);"></div>

        <div class="container reveal position-relative z-1">
            <h1 class="ff-serif display-1 fw-bold mb-4 text-light" style="letter-spacing: 2px;">
                Selamat Datang di <span class="text-accent">Niskala</span> Cafe
            </h1>
            <p class="lead mb-5 text-light opacity-75">
                Temukan pengalaman kopi terbaik, suasana eksklusif, dan hidangan lezat.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-column flex-sm-row">
                <a href="{{ route('reservasi.index') }}" class="btn btn-accent btn-lg shadow">
                    Reservasi Meja
                </a>
                <a href="{{ route('menu.index') }}" class="btn btn-outline-light btn-lg border-2 shadow"
                    style="border-radius: 50px; font-weight: 600;">
                    Pesan Menu
                </a>
            </div>
        </div>
    </section>

    <div class="container my-5 reveal">
        <hr class="border-secondary opacity-50">
    </div>

    <section id="layanan" class="py-5">
        <div class="container">
            <div class="text-center mb-5 reveal">
                <h2 class="ff-serif display-5 fw-bold text-accent mb-3">Pilih Layanan Anda</h2>
                <p class="text-muted lead">Jadwalkan kunjungan Anda atau pesan menu favorit.</p>
            </div>

            <div class="row g-4 justify-content-center">

                <div class="col-lg-5 col-md-6 reveal" style="transition-delay: 0.2s;">
                    <div class="custom-card p-4 h-100 d-flex flex-column text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="var(--accent-color)"
                            class="bi bi-calendar-check mx-auto mb-3" viewBox="0 0 16 16">
                            <path
                                d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                            <path
                                d="M11 1V.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h2.5a.5.5 0 0 1 0 1H13a.5.5 0 0 0 .5-.5V2a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 0 0 1h1V1z" />
                        </svg>
                        <h3 class="ff-serif text-light mb-3">Reservasi Meja</h3>
                        <p class="text-muted flex-grow-1">Amankan spot terbaik Anda untuk tanggal dan waktu yang
                            spesifik.
                        </p>
                        <a href="{{ route('reservasi.index') }}" class="btn btn-outline-light mt-3"
                            style="border-radius: 50px;">
                            Pesan Meja &rarr;
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 col-md-6 reveal" style="transition-delay: 0.4s;">
                    <div class="custom-card p-4 h-100 d-flex flex-column text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="var(--accent-color)"
                            class="bi bi-basket mx-auto mb-3" viewBox="0 0 16 16">
                            <path
                                d="M5.757 1.071a.5.5 0 0 1 .5.5v1a.5.5 0 1 1-1 0v-1a.5.5 0 0 1 .5-.5zm.753 5.487c-.675-.487-1.464-.81-2.28-.908L2.748 4.29a1.001 1.001 0 0 0-1.077-.282L1.14 4.596a.5.5 0 1 0 .282 1.077l1.04-.26h1.745c.783 0 1.488.351 2.11.838l.19-.137a.5.5 0 0 1 .632.753l-2.11.838a2.5 2.5 0 0 1-1.742 0L2.75 6.892l-.19.137a.5.5 0 0 1-.632-.753l2.11-.838c.675-.487 1.464-.81 2.28-.908l1.012-1.013c.098-.073.18-.158.243-.257a.5.5 0 0 1 .71.71c-.063.099-.145.184-.243.257L8.748 7.29a1.001 1.001 0 0 0 1.077.282l.462-.224a.5.5 0 0 1 .452.88l-.462.224a2.001 2.001 0 0 1-2.155-.563L5.757 6.558z" />
                        </svg>
                        <h3 class="ff-serif text-light mb-3">Pemesanan Menu</h3>
                        <p class="text-muted flex-grow-1">Pesan makanan dan minuman terbaik kami, bisa untuk *takeaway*
                            atau
                            *dine-in*.</p>
                        <a href="{{ route('menu.index') }}" class="btn btn-outline-light mt-3"
                            style="border-radius: 50px;">
                            Lihat Menu &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-secondary mt-5">
        <div class="container text-center reveal">
            <h2 class="ff-serif text-light mb-3">Siap untuk Pengalaman Terbaik?</h2>
            <p class="lead text-muted mb-4">Ayo jelajahi menu kami atau amankan tempat duduk Anda sekarang juga!</p>
            <a href="{{ route('menu.index') }}" class="btn btn-accent btn-lg shadow">
                Jelajahi Menu
            </a>
            <a href="{{ route('reservasi.index') }}" class="btn btn-outline-light btn-lg shadow ms-3"
                style="border-radius: 50px;">
                Reservasi Sekarang
            </a>
        </div>
    </section>
</div>
