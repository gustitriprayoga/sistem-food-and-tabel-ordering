<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Sweet Alert
        $title = 'Hapus Meja!';
        $text = "Apakah Kamu Ingin Menghapus Meja Ini ?";
        confirmDelete($title, $text);

        // Logika
        $meja = Meja::all();


        return view('backend.meja.index', compact('meja'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:mejas,nama',
            'kode' => 'required|string|max:255|unique:mejas,kode',
            'bentuk' => 'required|string|max:255',
        ]);

        try {
            Meja::create([
                'nama' => $request->nama,
                'kode' => $request->kode, // jika kamu pakai kode sebagai nama
                'bentuk' => $request->bentuk,
                'pos_x' => 0,
                'pos_y' => 0,
                'status' => 'tersedia'
            ]);

            return redirect()->back()->with('success', 'Meja berhasil ditambahkan!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Meja gagal ditambahkan!')->withInput();
        }
    }


    public function updatePosisi(Request $request)
    {
        $meja = Meja::findOrFail($request->id);
        $meja->update([
            'pos_x' => $request->pos_x,
            'pos_y' => $request->pos_y
        ]);

        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $meja = Meja::findOrFail($request->id);
        $meja->delete();

        return redirect()->back()->with('success', 'Meja berhasil dihapus.');
    }
}
