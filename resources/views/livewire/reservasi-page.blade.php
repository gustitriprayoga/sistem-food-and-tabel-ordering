<div class="container py-5 reveal">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="custom-card p-4 p-md-5">
                <h1 class="ff-serif text-accent mb-4 text-center">Reservasi Meja Anda 📝</h1>

                <nav class="mb-5">
                    <ol class="breadcrumb justify-content-center" style="--bs-breadcrumb-divider: '>';">
                        <li class="breadcrumb-item {{ $step == 1 ? 'text-accent fw-bold' : 'text-muted' }}">Waktu & Kapasitas</li>
                        <li class="breadcrumb-item {{ $step == 2 ? 'text-accent fw-bold' : 'text-muted' }}">Pilih Meja</li>
                        <li class="breadcrumb-item {{ $step == 3 ? 'text-accent fw-bold' : 'text-muted' }}">Konfirmasi & Bayar</li>
                    </ol>
                </nav>

                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                @endif

                @if ($step === 1)
                    <form wire:submit.prevent="nextStep">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="tanggal" class="form-label text-light">Tanggal Reservasi</label>
                                <input type="date" wire:model.live="tanggal_reservasi" id="tanggal" class="form-control bg-secondary text-light border-0" required>
                                @error('tanggal_reservasi') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="waktu" class="form-label text-light">Waktu Reservasi</label>
                                <input type="time" wire:model.live="waktu_reservasi" id="waktu" class="form-control bg-secondary text-light border-0" required>
                                @error('waktu_reservasi') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12">
                                <label for="jumlah_orang" class="form-label text-light">Jumlah Orang</label>
                                <input type="number" wire:model.live="jumlah_orang" id="jumlah_orang" min="1" class="form-control bg-secondary text-light border-0" placeholder="Minimal 1 orang" required>
                                @error('jumlah_orang') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-accent btn-lg">Lanjut Pilih Meja &rarr;</button>
                        </div>
                    </form>
                @endif

                @if ($step === 2)
                    <h4 class="text-light mb-3">Pilih Meja yang Tersedia:</h4>

                    @if ($mejaTersedia)
                        <div class="row g-3 mb-4">
                            @foreach ($mejaTersedia as $meja)
                                <div class="col-md-4">
                                    <div wire:click="selectMeja({{ $meja->id }})"
                                         class="custom-card p-3 text-center border {{ $meja_id == $meja->id ? 'border-accent' : 'border-secondary' }} cursor-pointer"
                                         style="{{ $meja_id == $meja->id ? 'transform: scale(1.03); border-width: 3px !important;' : '' }}">
                                        <h5 class="mb-1 text-accent">{{ $meja->nama }}</h5>
                                        <p class="text-muted small">Kapasitas: {{ $meja->kapasitas }} Orang</p>
                                        <p class="small {{ $meja_id == $meja->id ? 'text-light fw-bold' : 'text-muted' }}">
                                            {{ $meja_id == $meja->id ? 'TERPILIH' : 'Pilih Meja' }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('meja_id') <span class="text-danger small d-block mb-3">{{ $message }}</span> @enderror
                    @endif

                    <div class="d-flex justify-content-between mt-4">
                        <button wire:click="$set('step', 1)" class="btn btn-outline-light">&larr; Kembali</button>
                        <button wire:click="nextStep" class="btn btn-accent" {{ is_null($meja_id) ? 'disabled' : '' }}>Lanjut Pembayaran &rarr;</button>
                    </div>
                @endif

                @if ($step === 3)
                    <h4 class="text-light mb-3">Konfirmasi Detail Anda:</h4>
                    <div class="p-4 bg-secondary rounded mb-4">
                        <p class="text-light mb-1">📅 Tanggal/Waktu: <span class="fw-bold text-accent">{{ $tanggal_reservasi }} pukul {{ $waktu_reservasi }}</span></p>
                        <p class="text-light mb-1">👨‍👩‍👧‍👦 Jumlah Orang: <span class="fw-bold">{{ $jumlah_orang }}</span></p>
                        <p class="text-light mb-0">💰 Uang Muka (DP): <span class="fw-bold text-accent">Rp {{ number_format($total_bayar, 0, ',', '.') }}</span></p>
                    </div>

                    <form wire:submit.prevent="checkoutReservasi">
                        <div class="mb-3">
                            <label for="catatan" class="form-label text-light">Catatan (Opsional)</label>
                            <textarea wire:model="catatan" id="catatan" class="form-control bg-secondary text-light border-0" rows="2" placeholder="Contoh: Perlu kursi bayi"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-light">Pilih Metode Pembayaran DP</label>
                            <div class="row g-2">
                                @foreach (['transfer_bank' => 'Transfer Bank', 'e_wallet' => 'E-Wallet', 'kasir' => 'Bayar di Kasir (segera)'] as $value => $label)
                                    <div class="col-sm-4">
                                        <input type="radio" wire:model="metode_pembayaran" value="{{ $value }}" id="metode-{{ $value }}" class="btn-check" autocomplete="off" {{ $value === 'kasir' ? 'disabled' : '' }}>
                                        <label class="btn w-100 {{ $metode_pembayaran == $value ? 'btn-accent text-dark fw-bold' : 'btn-outline-light' }}" for="metode-{{ $value }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('metode_pembayaran') <span class="text-danger small d-block mt-2">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button wire:click="$set('step', 2)" type="button" class="btn btn-outline-light">&larr; Koreksi Meja</button>
                            <button type="submit" class="btn btn-accent btn-lg">Lanjut Pembayaran</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
