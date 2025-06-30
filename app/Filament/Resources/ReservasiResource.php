<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservasiResource\Pages;
use App\Filament\Resources\ReservasiResource\RelationManagers;
use App\Models\Reservasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists; // jangan lupa import
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReservasiResource extends Resource
{
    protected static ?string $model = Reservasi::class;

    protected static ?string $navigationGroup = 'Manajemen Reservasi';

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole(['admin']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->hasRole(['admin']);
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->hasAnyRole(['admin']);
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_reservasi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('user_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('meja_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\DatePicker::make('tanggal_reservasi')
                    ->required(),
                Forms\Components\TextInput::make('waktu_reservasi')
                    ->required(),
                Forms\Components\TextInput::make('jumlah_orang')
                    ->numeric()
                    ->default(null),
                Forms\Components\Textarea::make('catatan')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('total_bayar')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('metode_pembayaran')
                    ->required(),
                Forms\Components\TextInput::make('status_pembayaran')
                    ->required(),
                Forms\Components\TextInput::make('bukti_pembayaran')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('tipe_pesanan')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_reservasi')->searchable(),
                Tables\Columns\TextColumn::make('user.name')->label('Pelanggan'),
                Tables\Columns\TextColumn::make('meja.nama'),
                Tables\Columns\TextColumn::make('total_bayar')->money('IDR')->sortable(),
                Tables\Columns\BadgeColumn::make('status_pembayaran')
                    ->colors([
                        'warning' => 'menunggu_konfirmasi',
                        'success' => 'lunas',
                        'danger' => 'pending',
                    ]),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'dikonfirmasi',
                        'success' => 'selesai',
                    ]),
                Tables\Columns\TextColumn::make('tanggal_reservasi')->date('d M Y'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
                        'lunas' => 'Lunas',
                    ]),
                Tables\Filters\Filter::make('tanggal_reservasi')
                    ->form([Forms\Components\DatePicker::make('created_from'),])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['created_from'],
                            fn(Builder $query, $date): Builder => $query->whereDate('tanggal_reservasi', '>=', $date),
                        );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('konfirmasi_pembayaran')
                    ->label('Konfirmasi Bayar')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    // Tampilkan aksi ini hanya jika statusnya 'menunggu_konfirmasi'
                    ->visible(fn(Reservasi $record): bool => $record->status_pembayaran === 'menunggu_konfirmasi')
                    ->action(function (Reservasi $record) {
                        $record->status_pembayaran = 'lunas';
                        $record->status = 'dikonfirmasi';
                        $record->save();
                    })
                    // Tambahkan konfirmasi modal
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // public static function infolist(Infolist $infolist): Infolist
    // {
    //     return $infolist->schema([
    //         Infolists\Components\Section::make('Info Reservasi')
    //             ->schema([
    //                 Infolists\Components\TextEntry::make('kode_reservasi'),
    //                 // ... tambahkan info lain seperti pelanggan, meja, tanggal
    //             ])->columns(2),
    //         Infolists\Components\Section::make('Info Pembayaran')
    //             ->schema([
    //                 Infolists\Components\TextEntry::make('total_bayar')->money('IDR'),
    //                 Infolists\Components\BadgeEntry::make('status_pembayaran'),
    //                 // Tampilkan gambar bukti pembayaran
    //                 Infolists\Components\ImageEntry::make('bukti_pembayaran')
    //                     ->label('Bukti Pembayaran')
    //                     ->visible(fn($record) => $record->bukti_pembayaran),
    //             ])->columns(3),
    //         Infolists\Components\Section::make('Detail Pesanan')
    //             ->schema([
    //                 // Tampilkan item-item pesanan
    //                 Infolists\Components\RepeatableEntry::make('detailReservasi')
    //                     ->schema([
    //                         Infolists\Components\TextEntry::make('variasiMenu.menu.nama')
    //                             ->label('Menu'),
    //                         Infolists\Components\TextEntry::make('variasiMenu.nama_variasi')
    //                             ->label('Variasi'),
    //                         Infolists\Components\TextEntry::make('jumlah'),
    //                         Infolists\Components\TextEntry::make('harga_saat_pesan')
    //                             ->label('Harga')
    //                             ->money('IDR'),
    //                     ])->columns(4)
    //             ]),
    //     ]);
    // }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReservasis::route('/'),
            'create' => Pages\CreateReservasi::route('/create'),
            'edit' => Pages\EditReservasi::route('/{record}/edit'),
        ];
    }
}
