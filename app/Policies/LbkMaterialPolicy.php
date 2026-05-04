<?php

namespace App\Policies;

use App\Models\LbkMaterial;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LbkMaterialPolicy
{
    use HandlesAuthorization;

    /**
     * Tentukan apakah user bisa melihat daftar program (Index).
     */
    public function viewAny(User $user): bool
    {
        // Semua user yang login (Admin & Kontributor) boleh masuk ke menu ini
        return true;
    }

    /**
     * Tentukan apakah user bisa melihat detail program.
     */
    public function view(User $user, LbkMaterial $lbkMaterial): bool
    {
        // Semua orang bisa lihat detail artikel milik siapa pun
        return true;
    }

    /**
     * Tentukan apakah user bisa membuat program baru.
     */
    public function create(User $user): bool
    {
        // Semua user yang punya akun boleh membuat program
        return true;
    }

    /**
     * Tentukan apakah user bisa mengedit program.
     */
    public function update(User $user, LbkMaterial $lbkMaterial): bool
    {
        // Cuma pemilik yang bisa edit. 
        return $user->role === 'admin' || $user->id === $lbkMaterial->user_id;
    }

    /**
     * Tentukan apakah user bisa menghapus program.
     */
    public function delete(User $user, LbkMaterial $lbkMaterial): bool
    {
        // Cuma pemilik yang bisa hapus
        return $user->role === 'admin' || $user->id === $lbkMaterial->user_id;
    }

    /**
     * Tentukan apakah user bisa mengembalikan data yang dihapus (Soft Delete).
     */
    public function restore(User $user, LbkMaterial $lbkMaterial): bool
    {
        // Cuma Admin yang punya otoritas restore
        return $user->role === 'admin';
    }

    /**
     * Tentukan apakah user bisa menghapus permanen.
     */
    public function forceDelete(User $user, LbkMaterial $lbkMaterial): bool
    {
        // Cuma Admin yang boleh hapus dari database selamanya
        return $user->role === 'admin';
    }
}
