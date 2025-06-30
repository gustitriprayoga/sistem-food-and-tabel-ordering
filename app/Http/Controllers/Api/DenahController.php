<?php
// app/Http/Controllers/Api/DenahController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Denah;
use App\Models\Meja;
use Illuminate\Http\Request;

class DenahController extends Controller
{
    // Method untuk mengambil data denah dan meja-mejanya
    public function getMeja(Denah $denah)
    {
        // Alih-alih mengirim seluruh objek, kita format ulang datanya.
        // Ini lebih aman dan mencegah circular reference.
        return response()->json([
            'id' => $denah->id,
            'nama' => $denah->nama,
            'path_gambar' => $denah->path_gambar,
            'meja' => $denah->meja->map(function ($meja) {
                // Ambil hanya data meja yang kita perlukan
                return [
                    'id' => $meja->id,
                    'nama' => $meja->nama,
                    'kapasitas' => $meja->kapasitas,
                    'status' => $meja->status,
                    'posisi_x' => $meja->posisi_x,
                    'posisi_y' => $meja->posisi_y,
                ];
            })
        ]);

        // dd($denah->meja);
    }

    // Method untuk update posisi x dan y dari meja
    public function updatePosisiMeja(Request $request, Meja $meja)
    {
        $validated = $request->validate([
            'posisi_x' => 'required|integer',
            'posisi_y' => 'required|integer',
        ]);

        $meja->update([
            'posisi_x' => $validated['posisi_x'],
            'posisi_y' => $validated['posisi_y'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Posisi ' . $meja->nama . ' berhasil diperbarui.',
        ]);
    }
}
