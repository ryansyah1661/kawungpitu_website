<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'sort_order',
        'icon',
    ];

    // Slug juga harus masuk sini Qi, biar URL kategori bisa ganti bahasa
    public array $translatable = ['name', 'slug'];

    /**
     * Relasi ke Artikel
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Relasi ke Program (LBK)
     */
    public function lbkMaterials()
    {
        return $this->hasMany(LbkMaterial::class);
    }

    /**
     * Scope: hanya kategori tipe artikel.
     */
    public function scopeArticleType(Builder $query)
    {
        return $query->where('type', 'article');
    }

    public function scopeLbkType(Builder $query)
    {
        return $query->where('type', 'lbk');
    }
}
