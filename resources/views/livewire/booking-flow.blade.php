<div class="booking-flow-container container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="custom-card p-4 p-md-5">
                <h1 class="ff-serif text-accent mb-4 text-center">Proses Booking (Step {{ $step }}/6)</h1>

                <nav class="mb-5">
                    <ol class="breadcrumb justify-content-center small" style="--bs-breadcrumb-divider: '>';">
                        <li class="breadcrumb-item {{ $step == 1 ? 'text-accent fw-bold' : 'text-muted' }}">1. Info</li>
                        <li class="breadcrumb-item {{ $step == 2 ? 'text-accent fw-bold' : 'text-muted' }}">2. Menu</li>
                        <li class="breadcrumb-item {{ $step == 3 ? 'text-accent fw-bold' : 'text-muted' }}">3. Meja</li>
                        <li class="breadcrumb-item {{ $step == 4 ? 'text-accent fw-bold' : 'text-muted' }}">4. Ringkasan
                        </li>
                        <li class="breadcrumb-item {{ $step == 5 ? 'text-accent fw-bold' : 'text-muted' }}">5. Bayar
                        </li>
                        <li class="breadcrumb-item {{ $step == 6 ? 'text-accent fw-bold' : 'text-muted' }}">6. Selesai
                        </li>
                    </ol>
                </nav>

                {{-- Indikator Loading Global --}}
                <div wire:loading.delay.long class="text-center p-3 bg-secondary rounded mb-4">
                    <p class="text-accent fw-bold mb-0">Memuat langkah selanjutnya...</p>
                </div>

                {{-- Menampilkan Pesan Error Livewire/PHP --}}
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Include Sub-Views --}}
                @if ($step === 1)
                    @include('livewire.booking-flow.step-1-info')
                @endif
                @if ($step === 2)
                    @include('livewire.booking-flow.step-2-menu')
                @endif
                @if ($step === 3)
                    @include('livewire.booking-flow.step-3-meja')
                @endif
                @if ($step === 4)
                    @include('livewire.booking-flow.step-4-summary')
                @endif
                @if ($step === 5)
                    @include('livewire.booking-flow.step-5-payment')
                @endif
                @if ($step === 6)
                    @include('livewire.booking-flow.step-6-success')
                @endif

                <div class="d-flex justify-content-between mt-5">
                    @if ($step > 1 && $step < 6)
                        <button wire:click="prevStep" class="btn btn-outline-light" wire:loading.attr="disabled">&larr;
                            Kembali</button>
                    @endif

                    @if ($step < 6)
                        <button wire:click="nextStep" class="btn btn-accent ms-auto" wire:loading.attr="disabled"
                            {{ $step === 5 && empty($metode_pembayaran) ? 'disabled' : '' }}>
                            <span wire:loading.remove>
                                {{ $step === 5 ? 'Konfirmasi & Bayar' : 'Lanjut &rarr;' }}
                            </span>
                            <span wire:loading>Memuat...</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
