<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Slug sudah tetap VARCHAR dari migrasi sebelumnya.
        // Hanya bersihkan data jika ada yang tersimpan sebagai JSON.
        DB::table('lbk_materials')->get()->each(function ($item) {
            $decoded = json_decode($item->slug, true);
            if (is_array($decoded)) {
                DB::table('lbk_materials')
                    ->where('id', $item->id)
                    ->update(['slug' => $decoded['id'] ?? $decoded['en'] ?? $item->slug]);
            }
        });
    }

    public function down(): void
    {
        // No-op
    }
};
