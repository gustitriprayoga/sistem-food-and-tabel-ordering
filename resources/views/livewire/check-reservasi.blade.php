<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="custom-card p-4 p-md-5">
                <h1 class="ff-serif text-accent mb-4 text-center">🔎 Cek Status & Pembayaran</h1>
                <p class="text-light text-center mb-5">Masukkan Kode Reservasi atau Pemesanan Anda.</p>

                <form wire:submit.prevent="checkCode">
                    <div class="input-group mb-4">
                        <input type="text" wire:model.live="kodeReservasi"
                               class="form-control form-control-lg border-0"
                               placeholder="Contoh: NKL-A1B2C3" required>
                        <button class="btn btn-accent text-dark fw-bold px-4" type="submit"
                                wire:loading.attr="disabled">
                            <span wire:loading.remove>Cek Kode</span>
                            <span wire:loading>Mencari...</span>
                        </button>
                    </div>
                    @error('kodeReservasi')
                        <p class="text-danger small mt-2">{{ $message }}</p>
                    @enderror
                </form>

                <hr class="border-secondary my-5">

                @if ($searchAttempted)
                    @if ($reservasiData)
                        <h4 class="text-light mb-3 border-bottom border-secondary pb-2">Detail Transaksi: {{ $reservasiData->kode_reservasi }}</h4>

                        <div class="p-3 mb-4 rounded" style="background-color: var(--bg-secondary);">
                            <div class="row text-light small">
                                <div class="col-md-6 mb-2">Tipe: <span class="fw-bold">{{ Str::title(str_replace('_', ' ', $reservasiData->tipe_pesanan)) }}</span></div>
                                <div class="col-md-6 mb-2">Meja: <span class="fw-bold text-accent">{{ $reservasiData->meja->nama ?? 'Bawa Pulang' }}</span></div>

                                <div class="col-md-6 mb-2">Tanggal: <span class="fw-bold">{{ $reservasiData->tanggal_reservasi }}</span></div>
                                <div class="col-md-6 mb-2">Waktu: <span class="fw-bold">{{ $reservasiData->waktu_reservasi }}</span></div>
                            </div>
                        </div>

                        <div class="p-3 mb-4 rounded" style="background-color: var(--bg-secondary);">
                             <h5 class="text-light mb-3">Status & Pembayaran</h5>
                            <div class="row text-light">
                                <div class="col-md-6 mb-2">Status Pesanan:
                                    <span class="fw-bold text-{{ $reservasiData->status === 'dikonfirmasi' ? 'success' : ($reservasiData->status === 'dibatalkan' ? 'danger' : 'warning') }}">{{ Str::title($reservasiData->status) }}</span>
                                </div>
                                <div class="col-md-6 mb-2">Status Bayar:
                                    <span class="fw-bold text-{{ $reservasiData->status_pembayaran === 'lunas' ? 'success' : 'warning' }}">{{ Str::title(str_replace('_', ' ', $reservasiData->status_pembayaran)) }}</span>
                                </div>
                                <div class="col-12 mt-2">Total Bayar:
                                    <span class="fw-bold h5 text-accent">Rp {{ number_format($reservasiData->total_bayar, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        @if ($reservasiData->detailReservasis->isNotEmpty())
                             <h5 class="text-light mb-3">Detail Menu Pre-Order</h5>
                             <ul class="list-unstyled small">
                                @foreach ($reservasiData->detailReservasis as $detail)
                                    <li class="d-flex justify-content-between text-muted border-bottom border-secondary py-1">
                                        <span>{{ $detail->variasiMenu->menu->nama }} ({{ $detail->variasiMenu->nama_variasi }})</span>
                                        <span>{{ $detail->jumlah }}x</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                    @else
                        <div class="alert alert-danger text-center">
                            Kode **{{ $kodeReservasi }}** tidak ditemukan. Silakan periksa kembali kode Anda.
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
</div>
