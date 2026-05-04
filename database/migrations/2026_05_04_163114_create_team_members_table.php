<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // Pakai JSON karena translatable
            $table->json('role');
            $table->json('description')->nullable(); // Hanya untuk Advisor
            $table->string('photo');
            $table->enum('type', ['advisor', 'structure'])->default('structure');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
