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
        Schema::table('programs', function (Blueprint $table) {
            $table->text('human_capital_note')->nullable();
            $table->text('social_capital_note')->nullable();
            $table->text('natural_capital_note')->nullable();
            $table->text('physical_capital_note')->nullable();
            $table->text('financial_capital_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn([
                'human_capital_note',
                'social_capital_note',
                'natural_capital_note',
                'physical_capital_note',
                'financial_capital_note'
            ]);
        });
    }
};