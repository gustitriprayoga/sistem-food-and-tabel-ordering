<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\User;
use App\Models\Meja;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $produk = Produk::all();

        $countMakanan = Produk::where('kategori_id', 1)->count();
        $countMinuman = Produk::where('kategori_id', 2)->count();
        $countSnack = Produk::where('kategori_id', 3)->count();
        $countUser = User::count();
        $countMeja = Meja::count();


        return view('backend.dashboard.index', compact('produk', 'countMakanan', 'countMinuman', 'countSnack', 'countUser', 'countMeja'));
    }
}
