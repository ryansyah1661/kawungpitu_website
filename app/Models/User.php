<?php

namespace App\Models;

// 🚀 IMPORT: Dua baris sakti wajib dari Filament v3
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

// 🔥 FIX: Wajib menambahkan 'implements FilamentUser' di ujung class
class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo',
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
        'last_seen_at' => 'datetime',
    ];

    /**
     * 🔐 GERBANG UTAMA production: Menentukan siapa saja yang boleh login ke /admin
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Opsi 1 (Paling Aman): Hanya user dengan kolom role bernilai 'admin' yang boleh masuk
        return in_array($this->role, ['admin', 'contributor']);
    }

    public function getFilamentAvatarUrl(): ?string
    {
        Log::info('avatar check', ['photo' => $this->profile_photo]);
        return $this->profile_photo ? asset('storage/' . $this->profile_photo) : null;
    }
}
