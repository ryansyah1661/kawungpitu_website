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
        // 1. Suntik kolom ke tabel Artikel (articles) dengan proteksi cek kolom
        Schema::table('articles', function (Blueprint $table) {
            if (!Schema::hasColumn('articles', 'status')) {
                $table->string('status')->default('pending')->after('is_published');
            }
            if (!Schema::hasColumn('articles', 'rejection_note')) {
                $table->text('rejection_note')->nullable()->after('status');
            }
        });

        // 2. Suntik kolom ke tabel Program (programs) dengan proteksi cek kolom
        Schema::table('programs', function (Blueprint $table) {
            if (!Schema::hasColumn('programs', 'approval_status')) {
                $table->string('approval_status')->default('pending')->after('is_published');
            }
            if (!Schema::hasColumn('programs', 'rejection_note')) {
                $table->text('rejection_note')->nullable()->after('approval_status');
            }
        });

        // 3. Suntik kolom ke tabel Album (albums) dengan proteksi cek kolom
        Schema::table('albums', function (Blueprint $table) {
            if (!Schema::hasColumn('albums', 'status')) {
                $table->string('status')->default('pending')->after('is_published');
            }
            if (!Schema::hasColumn('albums', 'rejection_note')) {
                $table->text('rejection_note')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'status')) $table->dropColumn('status');
            if (Schema::hasColumn('articles', 'rejection_note')) $table->dropColumn('rejection_note');
        });

        Schema::table('programs', function (Blueprint $table) {
            if (Schema::hasColumn('programs', 'approval_status')) $table->dropColumn('approval_status');
            if (Schema::hasColumn('programs', 'rejection_note')) $table->dropColumn('rejection_note');
        });

        Schema::table('albums', function (Blueprint $table) {
            if (Schema::hasColumn('albums', 'status')) $table->dropColumn('status');
            if (Schema::hasColumn('albums', 'rejection_note')) $table->dropColumn('rejection_note');
        });
    }
};