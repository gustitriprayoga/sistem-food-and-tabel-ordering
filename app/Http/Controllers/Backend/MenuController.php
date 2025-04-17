<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sweet Alert
        $title = 'Hapus Produk!';
        $text = "Apakah Kamu Ingin Menghapus Produk Ini ?";
        confirmDelete($title, $text);

        // Logika
        $produk = Produk::all();
        return view('backend.menu.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('backend.menu.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'nullable|string|max:1000',
            'status' => 'required|boolean',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $produk = new Produk();
            $produk->nama = $request->nama;
            $produk->kategori_id = $request->kategori_id;
            $produk->harga = $request->harga;
            $produk->stok = $request->stok;
            $produk->deskripsi = $request->deskripsi;
            $produk->status = $request->status;

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('images/produk', $filename, 'public');
                $produk->gambar = 'images/produk/' . $filename;
            }

            $produk->save();

            return redirect()->route('menu.index')->with('success', 'Menu Berhasil Di Buat.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Gagal Memasukkan Menu: ' . $th->getMessage());
        }
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
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();

        return view('backend.menu.edit', compact('produk', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'deskripsi' => 'nullable|string|max:1000',
            'status' => 'required|boolean',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $produk = Produk::findOrFail($id);
            $produk->nama = $request->nama;
            $produk->kategori_id = $request->kategori_id;
            $produk->harga = $request->harga;
            $produk->stok = $request->stok;
            $produk->deskripsi = $request->deskripsi;
            $produk->status = $request->status;

            if ($request->hasFile('gambar')) {
                if ($produk->gambar) {
                    \Storage::disk('public')->delete($produk->gambar);
                }
                $file = $request->file('gambar');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('images/produk', $filename, 'public');
                $produk->gambar = 'images/produk/' . $filename;
            }

            $produk->save();

            return redirect()->route('menu.index')->with('success', 'Menu Berhasil Di Update.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Gagal Memperbarui Menu: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $produk = Produk::findOrFail($id);
            if ($produk->gambar) {
                \Storage::disk('public')->delete($produk->gambar);
            }
            $produk->delete();

            return redirect()->route('menu.index')->with('success', 'Menu Berhasil Di Hapus.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Gagal Menghapus Menu: ' . $th->getMessage());
        }
    }
}
