<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat Roles
        $adminRole = Role::create(['name' => 'admin']);
        $karyawanRole = Role::create(['name' => 'karyawan']);
        $pelangganRole = Role::create(['name' => 'pelanggan']);

        // Buat User Admin Utama
        $admin = User::create([
            'name' => 'Admin Niskala',
            'email' => 'admin@niskala.com',
            'password' => Hash::make('admin123'),
        ]);
        $admin->assignRole($adminRole);

        // Buat User Karyawan
        $karyawan = User::create([
            'name' => 'Karyawan Niskala',
            'email' => 'karyawan@niskala.com',
            'password' => Hash::make('karyawan'),
        ]);
        $karyawan->assignRole($karyawanRole);

        // Buat 10 User Pelanggan menggunakan Factory
        User::factory(10)->create()->each(function ($user) use ($pelangganRole) {
            $user->assignRole($pelangganRole);
        });
    }
}