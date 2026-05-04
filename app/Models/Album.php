<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Album extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['title', 'slug', 'description', 'cover_image', 'is_published', 'sort_order'];

    public $translatable = ['title', 'description'];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * Get all photos in this album.
     */
    public function photos()
    {
        return $this->hasMany(AlbumPhoto::class)->orderBy('sort_order');
    }

    /**
     * Scope: hanya album yang sudah dipublish.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Get jumlah foto di album ini.
     */
    public function getPhotoCountAttribute(): int
    {
        return $this->photos()->count();
    }
}
