<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Program;
use Illuminate\Database\Seeder;

class LbkMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $pengelolaanHutan = Category::where('slug', 'pengelolaan-hutan')->first();
        $agroforestri = Category::where('slug', 'agroforestri')->first();
        $kewirausahaan = Category::where('slug', 'kewirausahaan-petani')->first();

        $materials = [
            [
                'category_id' => $pengelolaanHutan->id,
                'title' => [
                    'id' => 'Dasar-Dasar Pengelolaan Hutan Lestari',
                    'en' => 'Fundamentals of Sustainable Forest Management',
                ],
                'slug' => 'dasar-pengelolaan-hutan-lestari',
                'excerpt' => [
                    'id' => 'Modul pengantar tentang prinsip-prinsip dasar pengelolaan hutan yang berkelanjutan.',
                    'en' => 'Introductory module on the basic principles of sustainable forest management.',
                ],
                'body' => [
                    'id' => '<p>Modul ini membahas konsep dasar pengelolaan hutan lestari, mencakup aspek ekologi, ekonomi, dan sosial. Peserta akan memahami prinsip-prinsip kelestarian dan bagaimana menerapkannya dalam konteks kehutanan Indonesia.</p><h3>Tujuan Pembelajaran</h3><ul><li>Memahami konsep hutan lestari</li><li>Mengenal komponen ekosistem hutan</li><li>Menerapkan prinsip kelestarian</li></ul>',
                    'en' => '<p>This module covers the basic concepts of sustainable forest management, including ecological, economic, and social aspects. Participants will understand sustainability principles and how to apply them in the Indonesian forestry context.</p><h3>Learning Objectives</h3><ul><li>Understand the concept of sustainable forests</li><li>Know forest ecosystem components</li><li>Apply sustainability principles</li></ul>',
                ],
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_published' => true,
                'published_at' => now()->subDays(30),
                'sort_order' => 1,
                'status' => 'ongoing',
                'view_count' => 245,
            ],
            [
                'category_id' => $agroforestri->id,
                'title' => [
                    'id' => 'Teknik Agroforestri untuk Petani Hutan',
                    'en' => 'Agroforestry Techniques for Forest Farmers',
                ],
                'slug' => 'teknik-agroforestri-petani-hutan',
                'excerpt' => [
                    'id' => 'Panduan praktis teknik agroforestri yang dapat diterapkan oleh petani hutan.',
                    'en' => 'Practical guide to agroforestry techniques applicable by forest farmers.',
                ],
                'body' => [
                    'id' => '<p>Agroforestri adalah sistem penggunaan lahan yang mengkombinasikan pepohonan dengan tanaman pertanian dan/atau ternak. Materi ini memberikan panduan praktis bagi petani hutan untuk menerapkan berbagai model agroforestri yang sesuai dengan kondisi lahan mereka.</p>',
                    'en' => '<p>Agroforestry is a land use system that combines trees with agricultural crops and/or livestock. This material provides practical guidance for forest farmers to implement various agroforestry models suitable for their land conditions.</p>',
                ],
                'is_published' => true,
                'published_at' => now()->subDays(25),
                'sort_order' => 2,
                'status' => 'ongoing',
                'view_count' => 189,
            ],
            [
                'category_id' => $kewirausahaan->id,
                'title' => [
                    'id' => 'Pemasaran Hasil Hutan untuk Petani',
                    'en' => 'Forest Product Marketing for Farmers',
                ],
                'slug' => 'pemasaran-hasil-hutan-petani',
                'excerpt' => [
                    'id' => 'Strategi pemasaran produk hasil hutan untuk meningkatkan pendapatan petani.',
                    'en' => 'Forest product marketing strategies to increase farmer income.',
                ],
                'body' => [
                    'id' => '<p>Materi ini membahas strategi pemasaran untuk produk-produk hasil hutan, mulai dari identifikasi pasar, pengemasan produk, hingga pemanfaatan platform digital untuk menjangkau konsumen yang lebih luas.</p>',
                    'en' => '<p>This material discusses marketing strategies for forest products, from market identification, product packaging, to utilizing digital platforms to reach wider consumers.</p>',
                ],
                'is_published' => true,
                'published_at' => now()->subDays(20),
                'sort_order' => 3,
                'status' => 'completed',
                'view_count' => 312,
            ],
        ];

        foreach ($materials as $material) {
            Program::create($material);
        }
    }
}
