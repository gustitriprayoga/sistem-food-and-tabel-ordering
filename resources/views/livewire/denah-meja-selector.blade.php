<div>
    @if ($denah)
        <div class="relative w-100 border border-secondary rounded-lg overflow-hidden bg-dark"
            style="background-image: url('{{ asset('storage/' . $denah->path_gambar) }}'); background-size: cover; background-position: center; padding-bottom: 56.25%;">

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
                    $borderClass = $selectedMejaId == $meja->id ? 'ring-4 ring-offset-2 ring-accent' : '';
                    $sizeClass = 'width: 40px; height: 40px;';
                @endphp

                <div wire:click="{{ $isTersedia ? 'selectMeja(' . $meja->id . ')' : '' }}"
                    style="left: {{ $meja->posisi_x }}%; top: {{ $meja->posisi_y }}%; {{ $sizeClass }}"
                    title="{{ $meja->nama }} (Kapasitas: {{ $meja->kapasitas }} | Status: {{ $meja->status }})"
                    class="position-absolute {{ $colorClass }} {{ $borderClass }} rounded-circle d-flex align-items-center justify-content-center text-light small fw-bold shadow">
                    {{ substr($meja->nama, 0, 3) }}
                </div>
            @endforeach

        </div>

        <div class="mt-4 d-flex flex-wrap gap-3 small text-muted">
            <span class="d-flex align-items-center"><span class="rounded-circle me-2"
                    style="width: 10px; height: 10px; background-color: #198754;"></span> Tersedia</span>
            <span class="d-flex align-items-center"><span class="rounded-circle me-2"
                    style="width: 10px; height: 10px; background-color: #ffc107;"></span> Dipesan</span>
            <span class="d-flex align-items-center"><span class="rounded-circle me-2"
                    style="width: 10px; height: 10px; background-color: #dc3545;"></span> Ditempati</span>
        </div>
    @else
        <p class="text-danger">Denah tidak ditemukan.</p>
    @endif
</div>
