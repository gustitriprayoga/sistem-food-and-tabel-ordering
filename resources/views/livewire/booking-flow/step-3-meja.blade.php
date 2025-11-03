<div>
    <h3 class="text-light mb-4 ff-serif text-accent">Langkah 3: Pilih Meja</h3>

    @if ($hanyaPesanMeja)
        <div class="alert custom-card bg-warning bg-opacity-10 border-start border-warning border-5 mb-4 p-3"
            style="background-color: var(--bg-secondary) !important;">
            <p class="mb-0 text-light">Anda belum memesan menu. Silakan pilih meja untuk **Reservasi Tempat Saja**.</p>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-3">
            <h5 class="text-accent">Pilih Denah</h5>
            <div class="d-flex flex-column gap-2 mb-3">
                @foreach (\App\Models\Denah::where('aktif', true)->get() as $denah)
                    <button wire:click="$set('selectedDenahId', {{ $denah->id }})"
                        class="btn btn-sm btn-{{ $selectedDenahId == $denah->id ? 'accent text-dark' : 'outline-light' }}">
                        {{ $denah->nama }}
                    </button>
                @endforeach
            </div>

            <p class="text-muted small mt-4">Meja dipilih harus memiliki kapasitas min. {{ $jumlah_orang }} orang.</p>
        </div>

        <div class="col-md-9">
            <h5 class="text-accent mb-3">Tampilan Meja Tersedia</h5>
            @if ($selectedDenahId)
                @livewire(
                    'denah-meja-selector',
                    [
                        'denahId' => $selectedDenahId,
                        'selectedMejaId' => $selectedMejaId,
                        'kapasitasMinimal' => $jumlah_orang,
                    ],
                    key('denah-' . $selectedDenahId)
                )
            @endif
            @error('selectedMejaId')
                <span class="text-danger small mt-2 d-block">{{ $message }}</span>
            @enderror

            @if ($selectedMejaId)
                <p class="mt-3 text-success fw-bold">Meja Terpilih:
                    {{ \App\Models\Meja::find($selectedMejaId)->nama ?? 'Meja tidak valid' }}</p>
            @endif
        </div>
    </div>
</div>
