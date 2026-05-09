<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop unique index pada slug dulu sebelum ubah ke JSON
        Schema::table('articles', function (Blueprint $table) {
            $table->dropUnique(['slug']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('slug')->change(); // Jangan kasih ->unique() di sini
            $table->json('excerpt')->change();
            $table->json('body')->change();
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('title')->change();
            $table->string('slug')->unique()->change(); // Balikin ke unique string
            $table->text('excerpt')->change();
            $table->text('body')->change();
        });
    }
};
