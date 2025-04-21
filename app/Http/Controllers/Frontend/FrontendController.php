<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // Halaman beranda
    public function home()
    {
        $menu = Produk::all();

        return view('frontend.index', compact('menu'));
    }

    public function booking()
    {
        return view('frontend.booking');
    }

    public function menu()
    {
        $menu = Produk::all();

        return view('frontend.menu', compact('menu'));
    }
}
