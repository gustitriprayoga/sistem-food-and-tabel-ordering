<?php

namespace App\Filament\Pages;

use App\Models\Meja;
use App\Models\Reservasi;
use Filament\Forms\Components\Textarea;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\View\View;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\FontWeight;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class DasborOperasional extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static string $view = 'filament.pages.dasbor-operasional';
    protected static ?string $title = 'Pesanan Masuk';
    protected static ?int $navigationSort = -1; // Taruh di paling atas

    // Properti untuk menyimpan data status semua meja
    public Collection $semuaMeja;


    // Aksi ini akan dipanggil oleh polling untuk me-refresh data meja
    protected function getlisteners(): array
    {
        return [
            'echo-private:broadcasting.orders,OrderCreated' => 'refreshMeja',
            'refreshMeja' => 'refreshMeja',
        ];
    }

    public function getViewData(): array
    {
        return [
            'semuaMeja' => $this->semuaMeja,
        ];
    }

    // Method untuk me-refresh data meja
    public function refreshMeja(): void
    {
        $this->semuaMeja = Meja::orderBy('nama')->get();
    }

    // mount() dijalankan saat halaman pertama kali dimuat
    public function mount(): void
    {
        $this->refreshMeja(); // Muat data meja pertama kali
    }

    // Konfigurasi untuk tabel "Pesanan Perlu Tindakan
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Reservasi::query()
                    ->whereIn('status', ['pending', 'dikonfirmasi'])
                    ->latest()
            )
            ->heading('Pesanan Perlu Tindakan')
            ->columns([
                TextColumn::make('user.name')->label('Pelanggan')->default('Guest'),
                TextColumn::make('created_at')->label('Masuk')->since(),
                BadgeColumn::make('status')->colors([
                    'warning' => 'pending',
                    'success' => 'dikonfirmasi',
                ]),
            ])
            ->actions([
                ViewAction::make()->iconButton()
                    ->tooltip('Lihat Detail Pesanan') // <-- Keterangan untuk tombol View
                    ->infolist([
                        Section::make('Info Reservasi')
                            ->columns(3)
                            ->schema([
                                TextEntry::make('user.name')->label('Nama Pelanggan')->default('Guest'),
                                TextEntry::make('meja.nama')->label('Meja')->default('Take Away'),
                                TextEntry::make('jumlah_orang')->label('Jumlah Orang'),
                                TextEntry::make('tanggal_reservasi')->date('d F Y'),
                                TextEntry::make('waktu_reservasi')->time('H:i'),
                                TextEntry::make('status')->badge()->colors([
                                    'warning' => 'pending',
                                    'success' => 'dikonfirmasi',
                                ]),
                                TextEntry::make('catatan')->columnSpanFull(),
                            ]),
                        Section::make('Info Pembayaran')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('status_pembayaran')->badge()->label('Status Bayar')->colors([
                                    'danger' => 'pending',
                                    'warning' => 'menunggu_konfirmasi',
                                    'success' => 'lunas',
                                ]),
                                TextEntry::make('metode_pembayaran')
                                    ->label('Metode Bayar')
                                    // Format teks agar lebih rapi (misal: 'transfer_bank' menjadi 'Transfer Bank')
                                    ->formatStateUsing(fn(string $state): string => \Illuminate\Support\Str::title(str_replace('_', ' ', $state)))
                                    // Tambahkan ikon dinamis berdasarkan metode bayar
                                    ->icon(fn(string $state): string => match ($state) {
                                        'kasir' => 'heroicon-o-user-circle',
                                        'transfer_bank' => 'heroicon-o-building-library',
                                        'e_wallet' => 'heroicon-o-qr-code',
                                        default => 'heroicon-o-credit-card',
                                    }),
                                ImageEntry::make('bukti_pembayaran')
                                    ->label('Bukti Pembayaran')
                                    // Logika ini sangat penting
                                    ->visible(fn($record) => !empty($record->bukti_pembayaran)),

                                TextEntry::make('total_bayar')
                                    ->label('Total Keseluruhan')
                                    ->money('IDR')
                                    ->weight(FontWeight::Bold) // Membuat teks menjadi tebal
                                    ->size(TextEntrySize::Large) // Membuat ukuran font lebih besar
                                    ->columnSpanFull(), // Membuatnya mengambil lebar penuh section
                                // Tampilkan gambar bukti bayar jika ada
                                ImageEntry::make('bukti_pembayaran')
                                    ->label('Bukti Pembayaran')
                                    ->visible(fn($record) => !empty($record->bukti_pembayaran)),
                            ]),
                        Section::make('Item Pesanan')
                            ->schema([
                                // Gunakan RepeatableEntry untuk menampilkan daftar item
                                RepeatableEntry::make('detailReservasi')
                                    ->label(false) // Sembunyikan label utama
                                    ->schema([
                                        TextEntry::make('variasiMenu.menu.nama')->label('Menu'),
                                        TextEntry::make('variasiMenu.nama_variasi')->label('Variasi'),
                                        TextEntry::make('jumlah')->label('Jml')->alignCenter(),
                                        TextEntry::make('harga_saat_pesan')->label('Subtotal')->money('IDR'),
                                    ])->columns(4),
                            ]),
                    ]),

                Action::make('konfirmasi_pembayaran')
                    ->label('Konfirmasi Bayar')
                    ->tooltip('Konfirmasi Pembayaran') // <-- Keterangan untuk tombol Konfirmasi Bayar
                    ->icon('heroicon-o-banknotes')->color('info')->iconButton()
                    ->infolist([
                        ImageEntry::make('bukti_pembayaran')
                            ->label('Bukti Pembayaran')
                            ->height(400)
                    ])
                    ->requiresConfirmation()
                    ->action(function (Reservasi $record) {
                        $record->status_pembayaran = 'lunas';
                        // Otomatis juga terima pesanan jika statusnya masih pending
                        if ($record->status === 'pending') {
                            $record->status = 'dikonfirmasi';
                        }
                        $record->save();

                        // Jika ada meja, ubah statusnya jadi 'dipesan'
                        if ($record->meja && $record->meja->status !== 'ditempati') {
                            $record->meja->update(['status' => 'dipesan']);
                        }
                        Notification::make()
                            ->title('Pembayaran Berhasil Di Konfirmasi.')
                            ->success()
                            ->send();
                        $this->refreshMeja(); // Refresh peta meja
                    })
                    // Tampilkan aksi ini hanya jika pembayaran menunggu konfirmasi
                    ->visible(fn(Reservasi $record): bool => $record->status_pembayaran === 'menunggu_konfirmasi'),

                // --- AKSI BARU: TERIMA PESANAN ---
                Action::make('terima')
                    ->label('Terima')
                    ->tooltip('Terima Reservasi') // <-- Keterangan untuk tombol Terima
                    ->icon('heroicon-o-check-circle')->color('success')->iconButton()
                    ->requiresConfirmation()
                    ->action(function (Reservasi $record) {
                        $record->status = 'dikonfirmasi';
                        $record->save();
                        // Jika ada meja, ubah statusnya jadi 'dipesan'
                        if ($record->meja) {
                            $record->meja->update(['status' => 'dipesan']);
                        }
                        Notification::make()
                            ->title('Reservasi Berhasil Diterima.')
                            ->success()
                            ->send();
                        $this->refreshMeja(); // Refresh peta meja setelah aksi
                    })
                    // Tampilkan aksi ini hanya jika status pesanan adalah 'pending'
                    ->visible(fn(Reservasi $record): bool => $record->status === 'pending'),


                // --- AKSI BARU: TOLAK PESANAN ---
                Action::make('tolak')
                    ->label('Tolak')
                    ->tooltip('Tolak Reservasi') // <-- Keterangan untuk tombol Tolak
                    ->icon('heroicon-o-x-circle')->color('danger')->iconButton()
                    ->requiresConfirmation()
                    // Tambahkan form untuk alasan penolakan
                    ->form([
                        Textarea::make('alasan_penolakan')
                            ->label('Alasan Penolakan')
                            ->required(),
                    ])
                    ->action(function (Reservasi $record, array $data) {
                        $record->status = 'dibatalkan';
                        // Simpan alasan penolakan di catatan
                        $record->catatan = 'Ditolak oleh karyawan. Alasan: ' . $data['alasan_penolakan'];
                        $record->save();
                        Notification::make()
                            ->title('Reservasi Berhasil DiTolak!.')
                            ->danger()
                            ->send();
                    })
                    // Tampilkan aksi ini hanya jika status pesanan adalah 'pending'
                    ->visible(fn(Reservasi $record): bool => $record->status === 'pending'),


                // Aksi 'selesaikan' yang sudah ada sebelumnya
                Action::make('selesaikan')
                    ->label('Selesaikan') // Saya tambahkan label untuk konsistensi
                    ->tooltip('Selesaikan Pesanan Ini') // <-- Keterangan untuk tombol Selesaikan
                    ->iconButton()->color('primary')->icon('heroicon-o-check-badge')
                    ->requiresConfirmation()
                    ->action(function (Reservasi $record) {
                        $record->status = 'selesai';
                        $record->save();
                        if ($record->meja) {
                            $record->meja->update(['status' => 'tersedia']);
                        }
                        Notification::make()
                            ->title('Pesanan ditandai selesai.')
                            ->success()
                            ->send();
                    })
                    ->visible(fn(Reservasi $record): bool => $record->status === 'dikonfirmasi'),
            ])
            ->poll('10s');
    }
}
