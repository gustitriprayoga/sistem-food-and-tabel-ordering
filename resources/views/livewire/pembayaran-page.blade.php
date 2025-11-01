<div class="container py-5 reveal">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="custom-card p-4 p-md-5">
                <h1 class="ff-serif text-accent mb-4 text-center">Checkout Pesanan Anda</h1>
                <p class="lead text-center text-muted">Langkah terakhir untuk menyelesaikan pesanan.</p>

                @if (!$orderData)
                    <div class="alert alert-danger text-center">Data pesanan tidak ditemukan.</div>
                @else
                    <div class="mt-4">
                        <h4 class="text-light border-bottom border-secondary pb-2 mb-3">Detail Pesanan</h4>
                        <div class="bg-secondary p-3 rounded">
                            <p class="text-light mb-1">Tipe: <span class="fw-bold text-accent">{{ $tipePesanan == 'reservasi' ? 'Reservasi Meja (DP)' : 'Pemesanan Menu' }}</span></p>
                            @if ($tipePesanan == 'reservasi')
                                <p class="text-light mb-1">Tanggal/Waktu: <span class="fw-bold">{{ $orderData['tanggal'] }} pukul {{ $orderData['waktu'] }}</span></p>
                            @else
                                <p class="text-light mb-1">Item Menu: <span class="fw-bold">{{ count($orderData['cart']) }} jenis</span></p>
                            @endif
                            <h3 class="mt-3 text-light">Total Pembayaran: <span class="text-accent fw-bold">Rp {{ number_format($totalBayar, 0, ',', '.') }}</span></h3>
                        </div>
                    </div>

                    <form wire:submit.prevent="completeOrder" class="mt-5">
                        <div class="mb-4">
                            <label class="form-label text-light">Metode Pembayaran</label>
                            <div class="row g-2">
                                @foreach (['transfer_bank' => 'Transfer Bank', 'e_wallet' => 'E-Wallet', 'kasir' => 'Bayar di Kasir'] as $value => $label)
                                    <div class="col-sm-4">
                                        <input type="radio" wire:model.live="metode_pembayaran" value="{{ $value }}" id="metode-{{ $value }}" class="btn-check" autocomplete="off">
                                        <label class="btn w-100 {{ $metode_pembayaran == $value ? 'btn-accent text-dark fw-bold' : 'btn-outline-light' }}" for="metode-{{ $value }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('metode_pembayaran') <span class="text-danger small d-block mt-2">{{ $message }}</span> @enderror
                        </div>

                        @if ($metode_pembayaran && $metode_pembayaran !== 'kasir')
                            <div class="alert alert-info bg-secondary border-0 text-light small">
                                Silakan transfer total **Rp {{ number_format($totalBayar, 0, ',', '.') }}** ke rekening/wallet kami. Bukti pembayaran dapat diunggah setelah konfirmasi.
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="catatan" class="form-label text-light">Catatan Tambahan (Opsional)</label>
                            <textarea wire:model="catatan" id="catatan" class="form-control bg-secondary text-light border-0" rows="2"></textarea>
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-accent btn-lg shadow">
                                Konfirmasi & Selesaikan Pesanan
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
