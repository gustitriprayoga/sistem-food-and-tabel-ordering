<?php

namespace Database\Seeders;

use App\Models\DetailReservasi;
use App\Models\Meja;
use App\Models\Reservasi;
use App\Models\User;
use App\Models\VariasiMenu;
use Illuminate\Database\Seeder;

class ReservasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelangganIds = User::role('pelanggan')->pluck('id');
        $mejaIds = Meja::pluck('id');
        $variasiMenu = VariasiMenu::all();

        for ($i = 0; $i < 75; $i++) { // Buat 75 data reservasi
            $reservasi = Reservasi::create([
                'kode_reservasi' => 'NK-' . now()->subDays(rand(0, 30))->format('Ymd') . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'user_id' => $pelangganIds->random(),
                'meja_id' => fake()->boolean(75) ? $mejaIds->random() : null, // 75% kemungkinan pesan meja
                'tanggal_reservasi' => fake()->dateTimeBetween('-1 month', 'now'),
                'waktu_reservasi' => fake()->randomElement(['10:00:00', '14:00:00', '19:00:00']),
                'jumlah_orang' => fake()->numberBetween(1, 6),
                'total_bayar' => 0, // Inisialisasi, akan diupdate
                'metode_pembayaran' => fake()->randomElement(['kasir', 'transfer_bank', 'e_wallet']),
                'tipe_pesanan' => 'makan_ditempat',
                'status' => fake()->randomElement(['pending', 'dikonfirmasi', 'selesai', 'dibatalkan']),
            ]);

            $totalBayar = 0;
            // Buat 1 sampai 4 item pesanan per reservasi
            for ($j = 0; $j < fake()->numberBetween(1, 4); $j++) {
                $item = $variasiMenu->random();
                $jumlah = fake()->numberBetween(1, 3);
                $hargaSaatPesan = $item->harga;
                $totalBayar += ($hargaSaatPesan * $jumlah);

                DetailReservasi::create([
                    'reservasi_id' => $reservasi->id,
                    'variasi_menu_id' => $item->id,
                    'jumlah' => $jumlah,
                    'harga_saat_pesan' => $hargaSaatPesan,
                ]);
            }

            // Update total bayar dan status pembayaran
            $reservasi->total_bayar = $totalBayar;

            if ($reservasi->metode_pembayaran == 'kasir') {
                $reservasi->status_pembayaran = 'lunas';
            } else {
                $status = fake()->randomElement(['pending', 'menunggu_konfirmasi', 'lunas']);
                $reservasi->status_pembayaran = $status;
                if ($status == 'menunggu_konfirmasi' || $status == 'lunas') {
                    $reservasi->bukti_pembayaran = 'images/bukti/contoh-bukti.jpg';
                }
            }
            $reservasi->save();
        }
    }
}
