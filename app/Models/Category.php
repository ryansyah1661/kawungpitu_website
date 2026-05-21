<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public array $translatable = ['name', 'slug'];

    /**
     * Relasi ke Artikel
     */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_category');
    }

    /**
     * Relasi ke Program
     */
    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class, 'category_program');
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
