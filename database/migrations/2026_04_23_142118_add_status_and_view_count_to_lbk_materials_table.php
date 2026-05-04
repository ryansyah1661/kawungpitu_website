<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lbk_materials', function (Blueprint $table) {
            $table->string('status')->default('ongoing')->after('sort_order'); // ongoing, completed
            $table->unsignedInteger('view_count')->default(0)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('lbk_materials', function (Blueprint $table) {
            $table->dropColumn(['status', 'view_count']);
        });
    }
};
