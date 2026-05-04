<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kolom title, excerpt, body sudah JSON dari migrasi awal.
        // Migrasi ini sekarang no-op karena kolom sudah sesuai.
    }

    public function down(): void
    {
        // No-op
    }
};
