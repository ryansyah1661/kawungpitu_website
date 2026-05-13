<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            // Mengubah kolom photo agar boleh kosong (nullable)
            $table->string('photo')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            // Mengembalikan ke wajib isi jika di-rollback
            $table->string('photo')->nullable(false)->change();
        });
    }
};
