<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Kategori Artikel
            [
                'name' => ['id' => 'Kehutanan', 'en' => 'Forestry'],
                'slug' => 'kehutanan',
                'type' => 'article',
                'sort_order' => 1,
            ],
            [
                'name' => ['id' => 'Edukasi', 'en' => 'Education'],
                'slug' => 'edukasi',
                'type' => 'article',
                'sort_order' => 2,
            ],
            [
                'name' => ['id' => 'Lingkungan', 'en' => 'Environment'],
                'slug' => 'lingkungan',
                'type' => 'article',
                'sort_order' => 3,
            ],
            [
                'name' => ['id' => 'Komunitas', 'en' => 'Community'],
                'slug' => 'komunitas',
                'type' => 'article',
                'sort_order' => 4,
            ],

            // Kategori LBK
            [
                'name' => ['id' => 'Pengelolaan Hutan', 'en' => 'Forest Management'],
                'slug' => 'pengelolaan-hutan',
                'type' => 'lbk',
                'sort_order' => 1,
            ],
            [
                'name' => ['id' => 'Agroforestri', 'en' => 'Agroforestry'],
                'slug' => 'agroforestri',
                'type' => 'lbk',
                'sort_order' => 2,
            ],
            [
                'name' => ['id' => 'Kewirausahaan Petani', 'en' => 'Farmer Entrepreneurship'],
                'slug' => 'kewirausahaan-petani',
                'type' => 'lbk',
                'sort_order' => 3,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
