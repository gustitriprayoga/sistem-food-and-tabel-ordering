<form wire:submit.prevent="nextStep">
    <h3 class="text-light mb-4 ff-serif text-accent">Langkah 5: Pilih Pembayaran</h3>

    <div class="custom-card p-4 mb-4">
        <h4 class="text-light border-bottom border-secondary pb-2 mb-3">Metode Pembayaran</h4>
        <div class="row g-3">
            @foreach (['transfer_bank' => 'Transfer Bank', 'e_wallet' => 'E-Wallet', 'kasir' => 'Bayar di Kasir'] as $value => $label)
                <div class="col-sm-4">
                    <input type="radio" wire:model.live="metode_pembayaran" value="{{ $value }}"
                        id="metode-{{ $value }}" class="btn-check" autocomplete="off">
                    <label
                        class="btn w-100 p-3 {{ $metode_pembayaran == $value ? 'btn-accent text-dark fw-bold' : 'btn-outline-light' }}"
                        for="metode-{{ $value }}">{{ $label }}</label>
                </div>
            @endforeach
        </div>
        @error('metode_pembayaran')
            <span class="text-danger small d-block mt-2">{{ $message }}</span>
        @enderror

        @if ($metode_pembayaran && $metode_pembayaran !== 'kasir')
            <div class="alert alert-info bg-dark border-0 text-light small mt-4">
                Anda memilih pembayaran non-tunai. Setelah konfirmasi, Anda akan menerima instruksi transfer.
            </div>
        @endif
    </div>

    <div class="custom-card p-4">
        <h4 class="text-light border-bottom border-secondary pb-2 mb-3">Catatan Tambahan</h4>
        <label for="catatan" class="form-label text-light">Catatan (Contoh: Alergi, Permintaan Khusus)</label>
        <textarea wire:model="catatan" id="catatan" class="form-control bg-secondary text-light border-0" rows="3"></textarea>
    </div>

    <button type="submit" class="d-none">Submit</button>
</form>
