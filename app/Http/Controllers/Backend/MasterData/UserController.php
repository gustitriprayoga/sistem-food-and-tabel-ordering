<?php

namespace App\Http\Controllers\Backend\MasterData;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sweet Alert
        $title = 'Hapus User!';
        $text = "Apakah Kamu Ingin Menghapus User Ini ?";
        confirmDelete($title, $text);

        // Logika
        $user = User::all();


        try {
            $user = User::all();

            return view('backend.masterdata.user.index', compact('user'));
        } catch (\Throwable $th) {
            //throw $th;\

            return redirect()->back()->with('error', 'Gagal Menampilkan Data User');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {

            return view('backend.masterdata.user.create');
        } catch (\Throwable $th) {
            //throw $th;

            return redirect()->back()->with('error', 'Gagal Menampilkan Form Tambah User');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return redirect()->route('backend.masterdata.user.index')->with('success', 'User Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Gagal Menambahkan User');
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
        try {
            $user = User::findOrFail($id);

            return view('backend.masterdata.user.edit', compact('user'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Gagal Menampilkan Form Edit User');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->password) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            return redirect()->back()->with('success', 'User Berhasil Diupdate');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Gagal Mengupdate User');
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->back()->with('success', 'User Berhasil Dihapus');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Gagal Menghapus User');
        }
    }
}
