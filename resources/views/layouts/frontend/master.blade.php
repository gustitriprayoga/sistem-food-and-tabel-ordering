<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Cafe Niskala</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-amber-600">Cafe Niskala</a>
            <button id="menu-toggle" class="md:hidden text-2xl text-amber-600 focus:outline-none">
                &#9776;
            </button>
            <div id="mobile-menu" class="hidden flex-col md:flex md:flex-row md:space-x-4 md:items-center">
                <a href="#" class="py-2 px-4 hover:text-amber-500">Beranda</a>
                <a href="#" class="py-2 px-4 hover:text-amber-500">Menu</a>
                <a href="#" class="py-2 px-4 hover:text-amber-500">Reservasi</a>
                <a href="#kontak" class="py-2 px-4 hover:text-amber-500">Kontak</a>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <div class="pt-24 min-h-screen">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-amber-600 text-white py-6 mt-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Cafe Niskala. All rights reserved.</p>
        </div>
    </footer>

    <!-- Toggle Script -->
    <script>
        const toggleBtn = document.getElementById('menu-toggle');
        const menu = document.getElementById('mobile-menu');

        toggleBtn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>

</body>

</html>
