<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AlbumPhoto extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['album_id', 'image_path', 'caption', 'sort_order', 'views'];

    public $translatable = ['caption'];

    /**
     * Get the album that owns this photo.
     */
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
