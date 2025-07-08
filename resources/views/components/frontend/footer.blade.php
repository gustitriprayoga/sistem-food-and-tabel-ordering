{{-- File: resources/views/components/frontend/footer.blade.php --}}
{{-- Desain footer baru menggunakan Bootstrap 5 dan gaya yang lebih menarik --}}
<footer id="kontak" class="py-5 bg-secondary">
    <div class="container py-4">
        <div class="row g-5">
            {{-- Kolom 1: Tentang Kami --}}
            <div class="col-lg-4 text-center text-lg-start">
                <h3 class="ff-serif fs-4 text-light mb-3">NISKALA KAFE</h3>
                <p class="text-muted">Tempat di mana setiap cangkir kopi adalah sebuah cerita. Kami menyajikan ketenangan
                    dan cita rasa otentik hanya untuk Anda.</p>
                <hr class="d-lg-none my-4" style="border-color: var(--border-color);">
            </div>

            {{-- Kolom 2: Tautan Cepat --}}
            <div class="col-lg-2 col-md-6 text-center text-lg-start">
                <h5 class="text-light mb-3">Tautan</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#keunggulan"
                            class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-75-hover">Keunggulan</a>
                    </li>
                    <li class="mb-2"><a href="#menu"
                            class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-75-hover">Menu</a>
                    </li>
                    <li class="mb-2"><a href="#denah"
                            class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-75-hover">Denah
                            Meja</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Hubungi Kami --}}
            <div class="col-lg-3 col-md-6 text-center text-lg-start">
                <h5 class="text-light mb-3">Hubungi Kami</h5>
                <ul class="list-unstyled text-muted">
                    <li class="mb-2">Jl. Kopi Senja No. 123</li>
                    <li class="mb-2">Bangkinang, Riau</li>
                    <li class="mb-2">niskala@kafe.com</li>
                </ul>
            </div>

            {{-- Kolom 4: Sosial Media --}}
            <div class="col-lg-3 text-center text-lg-start">
                <h5 class="text-light mb-3">Ikuti Kami</h5>
                <p class="text-muted small">Dapatkan info terbaru dan promo menarik.</p>
                <div class="d-flex justify-content-center justify-content-lg-start gap-3 mt-3">
                    <style>
                        .social-icon {
                            display: inline-flex;
                            width: 40px;
                            height: 40px;
                            align-items: center;
                            justify-content: center;
                            border-radius: 50%;
                            background-color: var(--border-color);
                            color: var(--text-muted);
                            transition: all 0.3s ease;
                        }

                        .social-icon:hover {
                            background-color: var(--accent-color);
                            color: var(--bg-dark);
                            transform: translateY(-3px);
                        }
                    </style>
                    {{-- Ganti '#' dengan link sosial media Anda --}}
                    <a href="#" class="social-icon">@svg('heroicon-o-globe-alt', 'icon', ['style' => 'width: 20px; height: 20px;'])</a>
                    <a href="#" class="social-icon">@svg('heroicon-o-chat-bubble-left-right', 'icon', ['style' => 'width: 20px; height: 20px;'])</a>
                    <a href="#" class="social-icon">@svg('heroicon-o-camera', 'icon', ['style' => 'width: 20px; height: 20px;'])</a>
                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="text-center text-muted border-top pt-4 mt-5" style="border-color: var(--border-color) !important;">
            <p class="small">&copy; {{ date('Y') }} Niskala Kafe. Dibuat dengan Penuh Cinta.</p>
        </div>
    </div>
</footer>
