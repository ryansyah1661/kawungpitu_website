<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah ke string langsung
        DB::statement('ALTER TABLE articles MODIFY slug VARCHAR(255)');

        // Update data dari JSON ke string jika ada data lama
        DB::table('articles')->get()->each(function ($item) {
            $decoded = json_decode($item->slug, true);
            if (is_array($decoded)) {
                DB::table('articles')
                    ->where('id', $item->id)
                    ->update(['slug' => $decoded['id'] ?? $decoded['en'] ?? $item->slug]);
            }
        });

        // Tambahkan unique index kembali
        Schema::table('articles', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->json('slug')->change();
        });
    }
};
