<form wire:submit.prevent="nextStep">
    <h3 class="text-light mb-4 ff-serif text-accent">Langkah 1: Detail Kunjungan</h3>

    <div class="row g-4">
        <div class="col-md-6">
            {{-- Hapus text-light di label, biarkan CSS parent yang mengatur --}}
            <label for="tanggal" class="form-label">Tanggal Reservasi</label>
            <input type="date" wire:model.live="tanggal_reservasi" id="tanggal" {{-- Hapus bg-secondary di input, biarkan CSS custom-card yang mengatur --}}
                class="form-control border-0 p-3" min="{{ now()->toDateString() }}" required>
            @error('tanggal_reservasi')
                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="waktu" class="form-label">Waktu Reservasi</label>
            <input type="time" wire:model.live="waktu_reservasi" id="waktu" class="form-control border-0 p-3"
                required>
            @error('waktu_reservasi')
                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-12">
            <label for="jumlah_orang" class="form-label">Jumlah Orang</label>
            <input type="number" wire:model.live="jumlah_orang" id="jumlah_orang" min="1"
                class="form-control border-0 p-3" placeholder="Minimal 1 orang" required>
            @error('jumlah_orang')
                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <button type="submit" class="d-none">Submit</button>
</form>
