<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class LbkMaterial extends Model
{
    use HasFactory, HasTranslations;

    const STATUS_ONGOING = 'ongoing';
    const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'author_name',
        'user_id',
        'excerpt',
        'body',
        'featured_image',
        'video_url',
        'pdf_file',
        'is_published',
        'published_at',
        'sort_order',
        'status',
        'view_count',
    ];

    public $translatable = ['title', 'excerpt', 'body'];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Get the category that owns this LBK material.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope: hanya materi yang sudah dipublish.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope: program sedang berjalan.
     */
    public function scopeOngoing($query)
    {
        return $query->where('status', self::STATUS_ONGOING);
    }

    /**
     * Scope: program selesai.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Cek apakah materi punya video YouTube.
     */
    public function hasVideo(): bool
    {
        return !empty($this->video_url);
    }

    /**
     * Cek apakah materi punya file PDF.
     */
    public function hasPdf(): bool
    {
        return !empty($this->pdf_file);
    }

    /**
     * Increment jumlah view.
     */
    public function incrementViewCount()
    {
        $this->increment('view_count');
    }

    /**
     * Label status untuk display.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_ONGOING => 'Sedang Berjalan',
            self::STATUS_COMPLETED => 'Selesai',
            default => $this->status,
        };
    }

    /**
     * Warna badge status.
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_ONGOING => 'bg-green-500',
            self::STATUS_COMPLETED => 'bg-blue-500',
            default => 'bg-gray-500',
        };
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
