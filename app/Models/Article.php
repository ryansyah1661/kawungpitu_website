<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Article extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'author_name',
        'user_id',
        'excerpt',
        'body',
        'featured_image',
        'is_published',
        'published_at',
        'view_count',
    ];

    public $translatable = ['title', 'excerpt', 'body'];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Relasi diubah menjadi Many-to-Many
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }

    /**
     * Scope: hanya artikel yang sudah dipublish.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope: urut berdasarkan tanggal publish terbaru.
     */
    public function scopeLatestPublished($query)
    {
        return $query->published()->latest('published_at');
    }

    /**
     * Increment jumlah view.
     */
    public function incrementViewCount()
    {
        $this->increment('view_count');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}