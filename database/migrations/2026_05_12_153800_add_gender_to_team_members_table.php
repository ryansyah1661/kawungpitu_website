<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('team_members', function (Blueprint $table) {
        // Tambahkan kolom gender, boleh kosong (nullable)
        $table->string('gender')->nullable()->after('type'); // Laki-laki atau Perempuan
    });
}

public function down(): void
{
    Schema::table('team_members', function (Blueprint $table) {
        $table->dropColumn('gender');
    });
}
};
