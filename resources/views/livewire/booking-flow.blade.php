<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="custom-card p-4 p-md-5 reveal">
                <h1 class="ff-serif text-accent mb-4 text-center">Proses Booking (Step {{ $step }}/6)</h1>

                <nav class="mb-5">
                </nav>

                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                @endif

                {{-- --- STEP 1: Detail Info --- --}}
                @if ($step === 1)
                    @include('livewire.booking-flow.step-1-info')
                @endif

                {{-- --- STEP 2: Pilih Menu --- --}}
                @if ($step === 2)
                    @include('livewire.booking-flow.step-2-menu')
                @endif

                {{-- --- STEP 3: Pilih Meja / Denah --- --}}
                @if ($step === 3)
                    @include('livewire.booking-flow.step-3-meja')
                @endif

                {{-- --- STEP 4: Detail Pesanan --- --}}
                @if ($step === 4)
                    @include('livewire.booking-flow.step-4-summary')
                @endif

                {{-- --- STEP 5: Pembayaran --- --}}
                @if ($step === 5)
                    @include('livewire.booking-flow.step-5-payment')
                @endif

                {{-- --- STEP 6: Konfirmasi --- --}}
                @if ($step === 6)
                    @include('livewire.booking-flow.step-6-success')
                @endif

                <div class="d-flex justify-content-between mt-5">
                    @if ($step > 1 && $step < 6)
                        <button wire:click="prevStep" class="btn btn-outline-light">&larr; Kembali</button>
                    @endif

                    @if ($step < 5)
                        <button wire:click="nextStep" class="btn btn-accent ms-auto">Lanjut &rarr;</button>
                    @elseif ($step === 5)
                        <button wire:click="nextStep" class="btn btn-accent ms-auto">Konfirmasi & Bayar</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
