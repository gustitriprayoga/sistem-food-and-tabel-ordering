<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? config('app.name', 'Niskala Kafe') }} - Pengalaman Kopi Terbaik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    @vite('resources/css/app.css')

    <style>
        :root {
            /* Warna Dasar Halaman */
            --bg-light: #ffffff;
            /* Putih bersih (Background Halaman) */
            --bg-dark: #111111;
            /* Hitam (Background Card Utama) */
            --bg-secondary: #222222;
            /* Abu-abu gelap (Background Input di Card) */
            --bg-secondary-light: #f8f8f8;
            /* Abu-abu terang (Background Area Sekunder) */

            /* Warna Teks */
            --text-light: #e8e8e8;
            /* Teks terang (digunakan di Card Hitam) */
            --text-dark: #111111;
            /* Teks gelap (digunakan di Background Putih) */
            --text-muted: #888888;
            /* Teks muted/sekunder */

            /* Aksen Oranye */
            --accent-color: #ff8c00;
            /* Aksen Oranye */
            --accent-hover: #ffA500;

            /* Border */
            --border-color-light: #dee2e6;
            /* Border terang */
            --border-color-dark: #333333;
            /* Border untuk card gelap */
        }

        /* --- BODY DAN TIPE FONT --- */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        .ff-serif {
            font-family: 'Lora', serif;
        }

        /* --- WARNA UMUM --- */
        .text-accent {
            color: var(--accent-color) !important;
        }

        .bg-accent {
            background-color: var(--accent-color) !important;
        }

        .text-light {
            color: var(--text-light) !important;
        }

        .bg-secondary {
            background-color: var(--bg-secondary-light) !important;
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        /* KOREKSI: Card Utama (Booking Flow) */
        .custom-card {
            background-color: var(--bg-dark);
            /* Background HITAM */
            color: var(--text-light);
            /* Teks PUTIH */
            border: 1px solid var(--border-color-dark);
            border-radius: 1rem;
            transition: all 0.4s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
        }

        .custom-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-color);
            box-shadow: 0 8px 20px rgba(255, 140, 0, 0.2);
        }

        /* --- NAVIGATION BAR --- */
        .navbar {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color-light);
        }

        .navbar .nav-link {
            color: var(--text-dark);
        }

        .navbar .nav-link:hover {
            color: var(--accent-color);
        }

        /* --- INPUT FIELD DAN FORM CONTROL --- */
        /* Input di dalam custom-card (Hitam) */
        .custom-card .form-control {
            background-color: var(--bg-secondary) !important;
            /* Abu-abu gelap kontras */
            color: var(--text-light) !important;
            /* Teks terang */
            border-color: var(--border-color-dark) !important;
            padding: 1rem;
            /* Padding lebih nyaman */
        }

        .custom-card .form-control:focus {
            border-color: var(--accent-color) !important;
            box-shadow: 0 0 0 0.25rem rgba(255, 140, 0, 0.25);
        }

        /* Input field di luar card (misalnya di area putih) */
        .form-control.bg-secondary {
            background-color: var(--bg-secondary-light) !important;
            color: var(--text-dark) !important;
            border-color: var(--border-color-light);
        }

        /* --- BUTTONS --- */
        .btn-accent {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: var(--text-dark);
            font-weight: 600;
            padding: 0.8rem 2rem;
            transition: all 0.3s ease;
            border-radius: 50px;
        }

        .btn-accent:hover {
            background-color: var(--accent-hover);
            border-color: var(--accent-hover);
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(255, 140, 0, 0.25);
        }

        /* Tombol outline ('Kembali') di dalam card gelap */
        .btn-outline-light {
            color: var(--text-light);
            border-color: var(--text-light);
        }

        .btn-outline-light:hover {
            background-color: var(--accent-color);
            color: var(--text-dark);
            border-color: var(--accent-color);
        }
    </style>

    @stack('styles')
</head>

<body class="antialiased">

    <x-frontend.header />

    <main>
        {{ $slot }}
    </main>

    <x-frontend.footer />

    @livewire('notifications')
    @livewireScripts

    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const revealElements = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });
            revealElements.forEach(el => observer.observe(el));
        });
    </script>

    @stack('scripts')
</body>

</html>
