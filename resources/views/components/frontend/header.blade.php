{{-- File: resources/views/components/frontend/header.blade.php --}}
<header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand ff-serif fw-bold fs-4 text-accent" href="{{ route('home') }}" wire:navigate>NISKALA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link px-3" href="#keunggulan">Keunggulan</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#menu">Menu</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#denah">Denah</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#kontak">Kontak</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="{{ route('pemesanan') }}" wire:navigate class="btn btn-accent">
                        Pesan Online
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
