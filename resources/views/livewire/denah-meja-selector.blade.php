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
            padding-bottom: 56.25%;
            height: 0;">


            @foreach ($mejas as $meja)
                @php
                    $isTersedia = $meja->status === 'tersedia';
                    $colorClass = match ($meja->status) {
                        'tersedia' => 'bg-success hover:bg-success-dark cursor-pointer',
                        'dipesan' => 'bg-warning cursor-not-allowed',
                        default => 'bg-danger',
                    };
                    $borderClass = $selectedMejaId == $meja->id ? 'border border-3 border-accent' : 'border-0';
                    $sizeClass = 'width: 45px; height: 45px; margin-right: 50px;'; // Tambahkan jarak horizontal

                    // --- KODE DEBUG PAKSA ---
                    $forceStyle = 'left: 50%; top: 50%; transform: translate(-50%, -50%); display: inline-block;';
                    // Jika Anda ingin melihat semua 15 meja: ubah left dan top sedikit untuk setiap meja
                    $offset = $loop->index * 5; // Offset 5% per meja
                    $forceStyle = 'left: ' . (5 + $offset) . '%; top: 50%; transform: translateY(-50%);';
                    // --- END KODE DEBUG PAKSA ---
                @endphp

                <div wire:click="{{ $isTersedia ? 'selectMeja(' . $meja->id . ')' : '' }}"
                    style="{{ $forceStyle }} {{ $sizeClass }}"
                    title="{{ $meja->nama }} (Kapasitas: {{ $meja->kapasitas }} | Status: {{ $meja->status }})"
                    class="position-absolute {{ $colorClass }} {{ $borderClass }} rounded-circle d-flex align-items-center justify-content-center text-white small fw-bold shadow-lg text-center">
                    {{ substr($meja->nama, 0, 3) }}
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
