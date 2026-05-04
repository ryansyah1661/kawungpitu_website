<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\AlbumPhoto;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    public function run(): void
    {
        $albums = [
            [
                'title' => ['id' => 'Kegiatan Lapangan 2024', 'en' => 'Field Activities 2024'],
                'slug' => 'kegiatan-lapangan-2024',
                'description' => [
                    'id' => 'Dokumentasi kegiatan lapangan Kawungpitu selama tahun 2024.',
                    'en' => 'Documentation of Kawungpitu field activities throughout 2024.',
                ],
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => ['id' => 'Workshop Petani Hutan', 'en' => 'Forest Farmer Workshop'],
                'slug' => 'workshop-petani-hutan',
                'description' => [
                    'id' => 'Momen-momen pelatihan dan workshop bersama petani hutan.',
                    'en' => 'Training and workshop moments with forest farmers.',
                ],
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => ['id' => 'Restorasi Lahan Kritis', 'en' => 'Critical Land Restoration'],
                'slug' => 'restorasi-lahan-kritis',
                'description' => [
                    'id' => 'Dokumentasi proses restorasi lahan kritis bersama masyarakat.',
                    'en' => 'Documentation of critical land restoration process with communities.',
                ],
                'is_published' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($albums as $albumData) {
            Album::create($albumData);
            // Catatan: foto akan ditambahkan melalui admin panel (Filament)
            // karena membutuhkan file gambar aktual
        }
    }
}
