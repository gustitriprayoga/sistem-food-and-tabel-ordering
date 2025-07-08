<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Niskala Kafe') }} - Pengalaman Kopi Terbaik</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <!-- Livewire & Filament Styles -->
    @livewireStyles
    @filamentStyles
    @vite('resources/css/app.css')

    <!-- Custom CSS untuk tema, warna, dan animasi -->
    <style>
        :root {
            /* Palet Warna Baru: Dramatis & Hangat */
            --bg-dark: #111111;
            /* Latar belakang utama (hitam arang) */
            --bg-secondary: #1a1a1a;
            /* Latar belakang section */
            --text-light: #e8e8e8;
            /* Warna teks utama (putih gading) */
            --text-muted: #888888;
            /* Warna teks sekunder */
            --accent-color: #ff8c00;
            /* Oranye matahari terbenam sebagai aksen utama */
            --accent-hover: #ffA500;
            /* Warna hover untuk aksen */
            --border-color: #333333;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-light);
            overflow-x: hidden;
            /* Mencegah scroll horizontal */
        }

        /* Tipografi Kustom */
        .ff-serif {
            font-family: 'Lora', serif;
        }

        .text-accent {
            color: var(--accent-color) !important;
        }

        .bg-accent {
            background-color: var(--accent-color) !important;
        }

        .bg-secondary {
            background-color: var(--bg-secondary);
        }

        /* Komponen Kustom */
        .navbar {
            background-color: rgba(17, 17, 17, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
        }

        .navbar .nav-link {
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar .nav-link:hover {
            color: var(--accent-color);
        }

        .btn-accent {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: #111;
            font-weight: 600;
            padding: 0.8rem 2rem;
            transition: all 0.3s ease;
            border-radius: 50px;
            /* Rounded pill */
        }

        .btn-accent:hover {
            background-color: var(--accent-hover);
            border-color: var(--accent-hover);
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(255, 140, 0, 0.25);
        }

        /* Animasi Reveal On Scroll */
        .reveal {
            position: relative;
            opacity: 0;
            transform: translateY(50px);
            transition: all 1s ease-out;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Card Kustom */
        .custom-card {
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .custom-card:hover {
            transform: translateY(-10px);
            border-color: var(--accent-color);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="antialiased">

    {{-- Memanggil Komponen Header --}}
    <x-frontend.header />

    {{-- Di sinilah konten dari setiap halaman akan dimasukkan --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Memanggil Komponen Footer --}}
    <x-frontend.footer />

    <!-- Livewire, Filament, dan Bootstrap JS -->
    @livewireScripts
    @livewire('notifications')
    @filamentScripts
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Script untuk Animasi On Scroll --}}
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
                threshold: 0.1 // Trigger saat 10% elemen terlihat
            });

            revealElements.forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>

</html>
