<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['question', 'answer', 'is_active', 'sort_order'];

    public $translatable = ['question', 'answer'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope: hanya FAQ yang aktif, diurutkan berdasarkan sort_order.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
