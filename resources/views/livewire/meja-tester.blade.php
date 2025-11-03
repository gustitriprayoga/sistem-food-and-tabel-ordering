<div class="container py-5">
    <div class="custom-card p-5">
        <h2 class="ff-serif text-accent mb-4">🧪 Pengujian Render Meja (Isolated)</h2>
        <p class="text-light">Meja seharusnya muncul di dalam kotak di bawah ini.</p>

        <hr class="border-secondary mb-4">

        @livewire(
            'denah-meja-selector',
            [
                'denahId' => $denahIdTest,
                'selectedMejaId' => null,
                'kapasitasMinimal' => $kapasitasTest,
            ],
            key('test-denah')
        )

        <p class="mt-4 text-muted small">Jika meja muncul di sini, masalahnya ada pada alur validasi atau data di
            komponen BookingFlow.</p>
        <p class="text-danger small">Jika meja tidak muncul, masalahnya 100% ada pada CSS/Koordinat Database/Path Gambar.
        </p>
    </div>
</div>
