<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'subject', 'message', 'is_read'];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Scope: hanya pesan yang belum dibaca.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Tandai pesan sebagai sudah dibaca.
     */
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }
}
