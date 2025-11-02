<div class="text-center py-5">
    <div class="display-3 text-success mb-3">🎉</div>
    <h2 class="ff-serif text-light mb-3">Booking Berhasil Dikonfirmasi!</h2>
    <p class="lead text-light">Simpan kode reservasi Anda:</p>
    <p class="display-4 fw-bold text-accent mb-4">{{ $kodeReservasi }}</p>

    <div class="alert alert-info bg-secondary border-0 text-light p-4 shadow-lg mb-4">
        <p class="fw-bold mb-2">Instruksi Pembayaran</p>
        <p class="small text-muted mb-0">Status pembayaran Anda adalah **menunggu konfirmasi**. Silakan selesaikan pembayaran sesuai metode yang Anda pilih dalam waktu 24 jam.</p>
    </div>

    <a href="{{ route('homepage') }}" class="text-muted mt-3 d-block">Kembali ke Beranda</a>
</div>
