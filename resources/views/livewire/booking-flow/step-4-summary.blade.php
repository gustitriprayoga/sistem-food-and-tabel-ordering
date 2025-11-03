<div class="row g-4">
    <div class="col-lg-12">
        <h3 class="text-light mb-4 ff-serif text-accent">Langkah 4: Ringkasan Pesanan</h3>
        <p class="text-muted mb-4">Pastikan semua detail di bawah ini sudah benar sebelum melanjutkan.</p>

        <div class="p-4 mb-4"
            style="background-color: var(--bg-secondary); border-radius: 0.5rem; border: 1px solid var(--border-color-dark);">
            <h4 class="text-light border-bottom border-secondary pb-2 mb-3">Informasi Reservasi</h4>
            <div class="row">
                <div class="col-md-6 text-light mb-2">Tanggal: <span
                        class="fw-bold text-accent">{{ $tanggal_reservasi }}</span></div>
                <div class="col-md-6 text-light mb-2">Waktu: <span
                        class="fw-bold text-accent">{{ $waktu_reservasi }}</span></div>
                <div class="col-md-6 text-light mb-2">Jumlah Orang: <span class="fw-bold">{{ $jumlah_orang }}</span>
                </div>
                <div class="col-md-6 text-light mb-2">Meja Terpilih: <span
                        class="fw-bold text-accent">{{ $selectedMejaId ? \App\Models\Meja::find($selectedMejaId)->nama ?? 'N/A' : 'Hanya Takeaway' }}</span>
                </div>
            </div>
        </div>

        <div class="p-4 mb-4"
            style="background-color: var(--bg-secondary); border-radius: 0.5rem; border: 1px solid var(--border-color-dark);">
            <h4 class="text-light border-bottom border-secondary pb-2 mb-3">Item Menu (Pre-Order)</h4>

            @if (empty($keranjang ?? []))
                <p class="text-muted">Tidak ada menu yang dipesan. Hanya reservasi tempat.</p>
            @else
                <ul class="list-unstyled">
                    @foreach ($keranjang as $id => $item)
                        <li
                            class="d-flex justify-content-between text-light py-1 border-bottom border-secondary border-opacity-50 small">
                            <span>{{ $item['nama'] }}</span>
                            <span>{{ $item['jumlah'] }}x @ Rp {{ number_format($item['harga'], 0, ',', '.') }}</span>
                            <span class="fw-bold text-accent">Rp
                                {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="p-4"
            style="background-color: var(--bg-secondary); border-radius: 0.5rem; border: 1px solid var(--border-color-dark);">
            <h4 class="text-light border-bottom border-secondary pb-2 mb-3">Total Biaya</h4>
            <div class="d-flex justify-content-between h6 text-light">
                <span>Total Menu:</span>
                <span class="text-accent">Rp {{ number_format($this->totalMenu, 0, ',', '.') }}</span>
            </div>
            <div class="d-flex justify-content-between h6 text-light">
                <span>Uang Muka Reservasi (DP):</span>
                <span class="text-accent">Rp {{ number_format($this->totalDP, 0, ',', '.') }}</span>
            </div>
            <hr class="border-accent opacity-75">
            <div class="d-flex justify-content-between h4 text-light fw-bold">
                <span>GRAND TOTAL (DP + Menu):</span>
                <span class="text-accent">Rp {{ number_format($this->totalBayar, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
