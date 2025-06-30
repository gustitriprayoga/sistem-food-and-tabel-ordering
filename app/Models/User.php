<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Logika untuk panel 'admin'
        if ($panel->getId() === 'admin') {
            // Hanya user dengan role 'admin' yang boleh masuk
            return $this->hasRole('admin');
        }

        // Logika untuk panel 'karyawan'
        if ($panel->getId() === 'karyawan') {
            // User dengan role 'karyawan' ATAU 'admin' boleh masuk
            // Kita izinkan admin agar bisa melakukan testing
            return $this->hasAnyRole(['karyawan', 'admin']);
        }

        // Untuk panel lain yang mungkin Anda buat di masa depan,
        // secara default izinkan akses (jika sudah login).
        return true;
    }
}
