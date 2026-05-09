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

    public array $translatable = ['name'];

    /**
     * Relasi ke Artikel
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Relasi ke Program
     */
    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    /**
     * Scope: hanya kategori tipe artikel.
     */
    public function scopeArticleType(Builder $query)
    {
        return $query->where('type', 'article');
    }

    public function scopeProgramType(Builder $query)
    {
        return $query->where('type', 'program');
    }
}
