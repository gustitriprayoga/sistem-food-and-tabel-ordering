<?php
namespace App\Filament\Widgets;

use App\Models\Reservasi;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $pendapatanHariIni = Reservasi::where('status_pembayaran', 'lunas')
            ->whereDate('created_at', Carbon::today())
            ->sum('total_bayar');

        $reservasiBaru = Reservasi::whereDate('created_at', Carbon::today())->count();
        $pelangganBaru = User::role('pelanggan')->whereDate('created_at', Carbon::today())->count();

        return [
            Stat::make('Pendapatan Hari Ini', 'Rp ' . number_format($pendapatanHariIni))
                ->description('Total penjualan lunas hari ini')
                ->color('success'),
            Stat::make('Reservasi Baru Hari Ini', $reservasiBaru)
                ->description('Semua pesanan yang masuk hari ini')
                ->color('info'),
            Stat::make('Pelanggan Baru Hari Ini', $pelangganBaru)
                ->description('Jumlah pelanggan baru terdaftar')
                ->color('primary'),
        ];
    }
}