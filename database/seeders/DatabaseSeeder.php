<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Urutan penting: Categories harus pertama (foreign key dependency)
        $this->call([
            CategorySeeder::class,
            ArticleSeeder::class,
            LbkMaterialSeeder::class,
            FaqSeeder::class,
            AlbumSeeder::class,
            UserSeeder::class,
        ]);
    }
}
