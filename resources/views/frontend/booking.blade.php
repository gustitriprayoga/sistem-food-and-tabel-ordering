@extends('layouts.frontend.master')

@section('title', 'Reservasi Meja')

@section('content')
    <section class="py-20 bg-yellow-50 px-4">
        <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold text-center mb-6">Reservasi Meja</h2>

            <form action="#" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-medium mb-1">Nama</label>
                    <input type="text" name="nama" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Nomor Telepon</label>
                    <input type="text" name="telepon" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Jumlah Orang</label>
                    <input type="number" name="jumlah_orang" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Waktu</label>
                    <input type="time" name="waktu" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="pt-4 text-center">
                    <button type="submit"
                        class="bg-yellow-400 hover:bg-yellow-300 px-6 py-2 rounded-lg text-black font-semibold">
                        Booking Sekarang
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
