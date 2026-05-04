<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    // Siapa yang bisa lihat daftar artikel? (Semua admin/kontributor yang login)
    public function viewAny(User $user): bool
    {
        // semua orang bisa lihat menu dan daftar artikel
        return true;
    }

    // Siapa yang bisa lihat detail artikel?
    public function view(User $user, Article $article): bool
    {
        // semua orang bisa lihat detail artikel milik siapa pun
        return true;
    }

    // Siapa yang bisa buat artikel baru?
    public function create(User $user): bool
    {
        return true; // Semua user yang punya akun boleh buat
    }

    public function update(User $user, Article $article): bool
    {
        // Cuma pemilik yang bisa edit
        return $user->role === 'admin' || $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article): bool
    {
        // Cuma pemilik yang bisa hapus
        return $user->role === 'admin' || $user->id === $article->user_id;
    }

    // Fungsi restore & forceDelete (biasanya cuma admin yang boleh)
    public function restore(User $user, Article $article): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, Article $article): bool
    {
        return $user->role === 'admin';
    }
}
