<div class="home-page-container">

    <section class="min-vh-100 d-flex align-items-center justify-content-center text-center p-5 position-relative"
        style="background: url('path/to/your/coffee_bg_dark.jpg') no-repeat center center; background-size: cover;">

        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.65);"></div>

        <div class="container position-relative z-1">
            <h1 class="ff-serif display-1 fw-bold mb-4 text-light" style="letter-spacing: 2px;">
                Selamat Datang di <span class="text-accent">Niskala</span> Cafe
            </h1>
            <p class="lead mb-5 text-light opacity-75">
                Temukan pengalaman kopi terbaik, suasana eksklusif, dan hidangan lezat.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-column flex-sm-row">
                {{-- Hanya satu tombol yang mengarahkan ke alur booking --}}
                <a href="{{ route('booking.start') }}" class="btn btn-accent btn-lg shadow">
                    Mulai Booking Sekarang!
                </a>
            </div>
        </div>
    </section>

    <div class="container my-5">
        <hr class="border-secondary opacity-50">
    </div>

    <section id="layanan" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="ff-serif display-5 fw-bold text-accent mb-3">Layanan Kami</h2>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-lg-5 col-md-6">
                    <div class="custom-card p-4 h-100 d-flex flex-column text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="var(--accent-color)"
                            class="bi bi-calendar-check mx-auto mb-3" viewBox="0 0 16 16">
                            <path
                                d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                            <path
                                d="M11 1V.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h2.5a.5.5 0 0 1 0 1H13a.5.5 0 0 0 .5-.5V2a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 0 0 1h1V1z" />
                        </svg>
                        <h3 class="ff-serif text-light mb-3">Reservasi & Pre-Order</h3>
                        <p class="text-muted flex-grow-1">Seluruh proses pemesanan tempat dan menu dilakukan dalam satu
                            alur mudah.</p>
                        <a href="{{ route('booking.start') }}" class="btn btn-outline-light mt-3"
                            style="border-radius: 50px;">
                            Mulai Proses &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-secondary mt-5">
        <div class="container text-center">
            <h2 class="ff-serif text-light mb-3">Ingin Merasakan Kenikmatan Niskala?</h2>
            <p class="lead text-muted mb-4">Pesan tempat Anda sekarang dan lihat menu kami.</p>
            <a href="{{ route('booking.start') }}" class="btn btn-accent btn-lg shadow">
                Mulai Booking
            </a>
        </div>
    </section>
</div>
