<?php

namespace App\Filament\Pages;

use App\Models\Reservasi;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PesananDapur extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static string $view = 'filament.pages.pesanan-dapur';
    protected static ?string $title = 'Pesanan Dapur';
    protected static ?string $navigationGroup = 'Operasional';
    protected static ?int $navigationSort = 2; // Urutan di bawah "Pesanan Masuk"

    public function table(Table $table): Table
    {
        return $table
            // Query: Hanya tampilkan pesanan yang sudah dikonfirmasi & siap dibuat
            ->query(
                Reservasi::query()
                    ->where('status', 'dikonfirmasi')
                    ->whereHas('detailReservasi') // Pastikan hanya yang ada pesanan menu
                    ->latest()
            )
            ->columns([
                TextColumn::make('kode_reservasi')
                    ->label('Kode'),

                // Kolom ini akan menampilkan daftar menu yang dipesan
                TextColumn::make('detail_pesanan')
                    ->label('Item Pesanan')
                    ->formatStateUsing(function ($record) {
                        // Ambil setiap item dari relasi, format, lalu gabungkan
                        return $record->detailReservasi->map(function ($item) {
                            return "{$item->jumlah}x {$item->variasiMenu->menu->nama} ({$item->variasiMenu->nama_variasi})";
                        })->implode('<br>'); // Gabungkan dengan tag <br>
                    })
                    ->html(), // Gunakan ->html() agar tag <br> dirender dengan benar

                TextColumn::make('meja.nama')
                    ->label('Meja')
                    ->default('Take Away'),

                TextColumn::make('catatan')
                    ->label('Catatan Pelanggan'),
            ])
            ->actions([
                // Aksi untuk menandai pesanan sudah siap/selesai
                Action::make('pesanan_siap')
                    ->label('Pesanan Siap')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->action(function (Reservasi $record) {
                        // Di sini Anda bisa menambahkan logika yang lebih kompleks,
                        // misalnya mengubah status baru 'kitchen_status' menjadi 'ready'.
                        // Untuk saat ini, kita tandai sebagai 'selesai'.
                        $record->status = 'selesai';
                        $record->save();
                        \Filament\Notifications\Notification::make()
                            ->title('Pesanan ditandai sudah siap/selesai.')
                            ->success()
                            ->send();
                    }),
            ])
            // Atur tabel untuk auto-refresh setiap 10 detik
            ->poll('10s');
    }
}
