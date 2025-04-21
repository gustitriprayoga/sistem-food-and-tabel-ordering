@extends('layouts.frontend.master')

@section('content')
    <!-- Hero Section -->
    <section class="bg-cover bg-center h-screen flex items-center justify-center"
        style="background-image: url('{{ asset('frontend/img/hero.jpg') }}')">
        <div class="text-center text-white bg-black/60 p-6 md:p-10 rounded-xl mx-4">
            <h1 class="text-3xl md:text-5xl font-bold mb-4">Selamat Datang di <span class="text-yellow-400">Cafe
                    Niskala</span></h1>
            <p class="text-base md:text-lg mb-6">Pesan menu favorit & reservasi meja kini lebih mudah dan cepat</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#" class="bg-yellow-400 text-black px-6 py-3 rounded-lg hover:bg-yellow-300">Lihat Menu</a>
                <a href="#" class="bg-white text-black px-6 py-3 rounded-lg hover:bg-gray-200">Booking Sekarang</a>
            </div>
        </div>
    </section>

    <!-- Menu Unggulan -->
    <section class="py-16 bg-white px-4">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Menu Unggulan</h2>
            <p class="text-gray-500 mb-8 text-sm md:text-base">Nikmati hidangan terbaik kami yang dibuat dengan sepenuh hati
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($menu as $item)
                    <div class="bg-gray-100 rounded-xl overflow-hidden shadow-md">
                        @if ($item->gambar)
                            <img src="{{ asset('storage/uploads/menu/' . $item->gambar) }}" alt="{{ $item->nama }}"
                                class="w-full h-56 object-cover">
                        @else
                            <img src="{{ asset('backend/dist/assets/images/products/empty-shopping-bag.gif') }}" alt="Default Image"
                                class="w-full h-56 object-cover">
                        @endif
                        <div class="p-4 text-left">
                            <h3 class="text-lg font-semibold">{{ $item->nama }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $item->deskripsi }}</p>
                            <span class="text-yellow-500 font-bold">Rp{{ number_format($item->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="#" class="inline-block mt-8 bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800">Lihat
                Semua Menu</a>
        </div>
    </section>

    <!-- Reservasi Section -->
    <section class="py-16 bg-yellow-50 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Reservasi Meja</h2>
            <p class="text-gray-600 mb-6 text-sm md:text-base">Ingin makan di tempat? Reservasi meja kamu sekarang juga!</p>
            <a href="#" class="bg-yellow-400 text-black px-6 py-3 rounded-lg hover:bg-yellow-300">Pesan Meja</a>
        </div>
    </section>

    <!-- Lokasi Section -->
    <section class="py-16 bg-white px-4">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Lokasi Kami</h2>
            <div class="mt-6">
                <iframe class="w-full h-72 md:h-96 rounded-lg"
                    src="https://maps.google.com/maps?q=Bangkinang%20Kota&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </section>
@endsection
