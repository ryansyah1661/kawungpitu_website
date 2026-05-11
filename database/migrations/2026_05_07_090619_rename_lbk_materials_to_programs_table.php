<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Rename tabel lama ke nama baru
        Schema::rename('lbk_materials', 'programs');

        // 2. Tambahkan kolom pilar modal ke tabel programs yang baru di-rename
        Schema::table('programs', function (Blueprint $table) {
            $table->integer('human_capital')->default(0);
            $table->integer('social_capital')->default(0);
            $table->integer('natural_capital')->default(0);
            $table->integer('physical_capital')->default(0);
            $table->integer('financial_capital')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn(['human_capital', 'social_capital', 'natural_capital', 'physical_capital', 'financial_capital']);
        });
        Schema::rename('programs', 'lbk_materials');
    }
};
