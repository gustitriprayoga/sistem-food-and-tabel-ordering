@extends('layouts.frontend.master')

@section('content')
    <section class="bg-cover bg-center h-screen flex items-center justify-center"
        style="background-image: url('{{ asset('frontend/img/hero.jpg') }}')">
        <div class="text-center text-white bg-black/60 p-10 rounded-xl">
            <h1 class="text-5xl font-bold mb-4">Selamat Datang di <span class="text-yellow-400">Cafe Niskala</span></h1>
            <p class="text-lg mb-6">Pesan menu favorit & reservasi meja kini lebih mudah dan cepat</p>
            <a href="#"
                class="bg-yellow-400 text-black px-6 py-3 rounded-lg mr-4 hover:bg-yellow-300">Lihat Menu</a>
            <a href="#" class="bg-white text-black px-6 py-3 rounded-lg hover:bg-gray-200">Pesan
                Meja</a>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Menu Unggulan</h2>
            <p class="text-gray-500 mb-8">Nikmati hidangan terbaik kami yang dibuat dengan sepenuh hati</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($menus as $menu)
                    <div class="bg-gray-100 rounded-xl overflow-hidden shadow-md">
                        <img src="{{ asset('storage/uploads/menu/' . $menu->gambar) }}" alt="{{ $menu->nama }}"
                            class="w-full h-56 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-semibold">{{ $menu->nama }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $menu->deskripsi }}</p>
                            <span class="text-yellow-500 font-bold">Rp{{ number_format($menu->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('menu.front') }}"
                class="inline-block mt-8 bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800">Lihat Semua Menu</a>
        </div>
    </section>

    <section class="py-16 bg-yellow-50">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Reservasi Meja</h2>
            <p class="text-gray-600 mb-6">Ingin makan di tempat? Reservasi meja kamu sekarang juga!</p>
            <a href="{{ route('meja.front') }}"
                class="bg-yellow-400 text-black px-6 py-3 rounded-lg hover:bg-yellow-300">Pesan Meja</a>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Lokasi Kami</h2>
            <div class="mt-6">
                <iframe class="w-full h-96 rounded-lg"
                    src="https://maps.google.com/maps?q=Bangkinang%20Kota&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </section>
@endsection
