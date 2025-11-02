<form wire:submit.prevent="nextStep">
    <h3 class="text-light mb-4 ff-serif text-accent">Langkah 1: Detail Kunjungan</h3>

    <div class="row g-4">
        <div class="col-md-6">
            <label for="tanggal" class="form-label text-light">Tanggal Reservasi</label>
            {{-- wire:model.live digunakan agar validasi dapat langsung berjalan di Livewire --}}
            <input type="date" wire:model.live="tanggal_reservasi" id="tanggal"
                class="form-control bg-secondary text-light border-0 p-3" min="{{ now()->toDateString() }}" required>
            @error('tanggal_reservasi')
                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="waktu" class="form-label text-light">Waktu Reservasi</label>
            <input type="time" wire:model.live="waktu_reservasi" id="waktu"
                class="form-control bg-secondary text-light border-0 p-3" required>
            @error('waktu_reservasi')
                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-12">
            <label for="jumlah_orang" class="form-label text-light">Jumlah Orang</label>
            <input type="number" wire:model.live="jumlah_orang" id="jumlah_orang" min="1"
                class="form-control bg-secondary text-light border-0 p-3" placeholder="Minimal 1 orang" required>
            @error('jumlah_orang')
                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
            @enderror
        </div>
    </div>

    {{-- Tombol nextStep disembunyikan karena sudah ada di layout utama booking-flow.blade.php,
        tapi kita bisa tetap memaksa validasi dengan tombol submit di sini jika mau --}}
</form>
