<div>
    {{-- DEBUGGING KODE --}}
    <div class="alert alert-info small p-2 text-dark bg-accent bg-opacity-75 mb-3">
        DEBUG: Denah ID: **{{ $denahId }}** | Kapasitas Min: **{{ $kapasitasMinimal }}** | Meja Ditemukan:
        **{{ $mejas->count() }}**
    </div>
    {{-- END DEBUGGING KODE --}}

    @if ($denah)
        {{-- Kontainer Denah: position-relative WAJIB ada --}}
        <div class="position-relative w-100 border border-secondary rounded-lg overflow-hidden bg-dark"
            style="background-image: url('{{ asset('storage/' . $denah->path_gambar) }}');
                   background-size: cover;
                   background-position: center;
                   /* KOREKSI: Set padding-bottom untuk rasio (membuat tinggi) */
                   padding-bottom: 56.25%;
                   min-height: 400px;
                   /* Hapus height: 0 yang menyebabkan container runtuh */">


            @foreach ($mejas as $meja)
                @php
                    $isTersedia = $meja->status === 'tersedia';
                    $colorClass = match ($meja->status) {
                        'tersedia' => 'bg-success hover:bg-success-dark cursor-pointer',
                        'dipesan' => 'bg-warning cursor-not-allowed',
                        'ditempati' => 'bg-danger cursor-not-allowed',
                        'tidak_tersedia' => 'bg-dark-subtle cursor-not-allowed',
                        default => 'bg-secondary',
                    };
                    $borderClass = $selectedMejaId == $meja->id ? 'border border-3 border-accent' : 'border-0';

                    // --- KODE POSISI PERMANEN DENGAN PIKSEL ---
                    $sizeClass = 'width: 80px; height: 70px;'; // Mengikuti ukuran di admin panel
                    // Transform untuk memusatkan elemen (karena Anda menggunakan ukuran 80x70)
                    $centering = 'transform: translate(-50%, -50%);';
                @endphp

                <div wire:click="{{ $isTersedia ? 'selectMeja(' . $meja->id . ')' : '' }}" {{-- KOREKSI UTAMA: Mengubah % menjadi px (sesuai data admin) --}}
                    style="left: {{ $meja->posisi_x }}px; top: {{ $meja->posisi_y }}px; {{ $sizeClass }} {{ $centering }}"
                    title="{{ $meja->nama }} (Kapasitas: {{ $meja->kapasitas }} | Status: {{ $meja->status }})"
                    class="position-absolute {{ $colorClass }} {{ $borderClass }} rounded-lg d-flex align-items-center justify-content-center text-white small fw-bold shadow-lg text-center flex-column">
                    <strong style="font-size: 1rem;">{{ $meja->nama }}</strong>
                    <small style="font-size: 0.7rem;">{{ Str::title(str_replace('_', ' ', $meja->status)) }}</small>
                </div>
            @endforeach

        </div>

        <div class="mt-4 d-flex flex-wrap gap-3 small text-muted">
            <span class="d-flex align-items-center"><span class="rounded-circle me-2"
                    style="width: 10px; height: 10px; background-color: #198754;"></span> Tersedia</span>
            <span class="d-flex align-items-center"><span class="rounded-circle me-2"
                    style="width: 10px; height: 10px; background-color: #ffc107;"></span> Dipesan</span>
        </div>
    @else
        <p class="text-danger">Denah tidak ditemukan atau tidak aktif.</p>
    @endif
</div>
