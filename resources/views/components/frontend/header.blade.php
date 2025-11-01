<nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3">
    <div class="container">
        <a class="navbar-brand ff-serif fw-bold" href="{{ route('homepage') }}">
            <span class="text-accent">Niskala</span> Cafe
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('homepage') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('menu.index') }}">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('reservasi.index') }}">Reservasi</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="btn btn-accent btn-sm ms-lg-3" href="/dashboard" style="border-radius: 50px;">Dashboard</a>
                </li>
                @endauth
                @guest
                <li class="nav-item">
                    <a class="btn btn-accent btn-sm ms-lg-3" href="/login" style="border-radius: 50px;">Masuk</a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
