<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $kehutanan = Category::where('slug', 'kehutanan')->first();
        $edukasi = Category::where('slug', 'edukasi')->first();
        $lingkungan = Category::where('slug', 'lingkungan')->first();
        $komunitas = Category::where('slug', 'komunitas')->first();

        $articles = [
            [
                'category_id' => $kehutanan->id,
                'title' => [
                    'id' => 'Strategi Pengelolaan Hutan Berkelanjutan di Indonesia',
                    'en' => 'Sustainable Forest Management Strategies in Indonesia',
                ],
                'slug' => 'strategi-pengelolaan-hutan-berkelanjutan',
                'excerpt' => [
                    'id' => 'Mengenal berbagai pendekatan dalam pengelolaan hutan yang berkelanjutan untuk menjaga ekosistem dan kesejahteraan masyarakat.',
                    'en' => 'Exploring various approaches to sustainable forest management to preserve ecosystems and community welfare.',
                ],
                'body' => [
                    'id' => '<p>Pengelolaan hutan berkelanjutan merupakan konsep yang menekankan keseimbangan antara pemanfaatan sumber daya hutan dan pelestarian lingkungan. Di Indonesia, dengan luas hutan tropis terbesar ketiga di dunia, tantangan ini menjadi sangat krusial.</p><p>Kawungpitu berkomitmen untuk mendampingi masyarakat dalam menerapkan praktik kehutanan yang berkelanjutan, termasuk sistem agroforestri, perhutanan sosial, dan pengelolaan hasil hutan bukan kayu (HHBK).</p><h3>Pendekatan yang Digunakan</h3><ul><li>Pemetaan partisipatif lahan hutan</li><li>Pengembangan sistem agroforestri</li><li>Pelatihan pengelolaan HHBK</li><li>Pendampingan sertifikasi hutan</li></ul>',
                    'en' => '<p>Sustainable forest management emphasizes the balance between forest resource utilization and environmental preservation. In Indonesia, with the third-largest tropical forest area in the world, this challenge is crucial.</p><p>Kawungpitu is committed to assisting communities in implementing sustainable forestry practices, including agroforestry systems, social forestry, and non-timber forest product (NTFP) management.</p><h3>Approaches Used</h3><ul><li>Participatory forest land mapping</li><li>Agroforestry system development</li><li>NTFP management training</li><li>Forest certification assistance</li></ul>',
                ],
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'view_count' => 150,
            ],
            [
                'category_id' => $edukasi->id,
                'title' => [
                    'id' => 'Pelatihan Petani Hutan: Membangun Kapasitas Lokal',
                    'en' => 'Forest Farmer Training: Building Local Capacity',
                ],
                'slug' => 'pelatihan-petani-hutan',
                'excerpt' => [
                    'id' => 'Program pelatihan intensif bagi petani hutan untuk meningkatkan keterampilan dan pengetahuan dalam pengelolaan lahan.',
                    'en' => 'Intensive training programs for forest farmers to enhance skills and knowledge in land management.',
                ],
                'body' => [
                    'id' => '<p>Kawungpitu secara rutin menyelenggarakan program pelatihan bagi petani hutan di berbagai wilayah di Jawa Barat. Program ini dirancang untuk meningkatkan kapasitas masyarakat lokal dalam mengelola sumber daya hutan secara produktif dan berkelanjutan.</p><p>Materi pelatihan mencakup teknik budidaya tanaman hutan, pengelolaan keuangan sederhana, dan pemasaran hasil hutan.</p>',
                    'en' => '<p>Kawungpitu regularly organizes training programs for forest farmers in various areas of West Java. These programs are designed to enhance the capacity of local communities in managing forest resources productively and sustainably.</p><p>Training materials cover forest crop cultivation techniques, basic financial management, and forest product marketing.</p>',
                ],
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'view_count' => 89,
            ],
            [
                'category_id' => $lingkungan->id,
                'title' => [
                    'id' => 'Dampak Perubahan Iklim terhadap Hutan Tropis',
                    'en' => 'Impact of Climate Change on Tropical Forests',
                ],
                'slug' => 'dampak-perubahan-iklim-hutan-tropis',
                'excerpt' => [
                    'id' => 'Analisis dampak perubahan iklim terhadap ekosistem hutan tropis dan upaya mitigasi yang dapat dilakukan.',
                    'en' => 'Analysis of climate change impacts on tropical forest ecosystems and possible mitigation efforts.',
                ],
                'body' => [
                    'id' => '<p>Perubahan iklim menjadi ancaman serius bagi kelestarian hutan tropis di Indonesia. Peningkatan suhu, perubahan pola curah hujan, dan peningkatan frekuensi kejadian iklim ekstrem berdampak signifikan terhadap biodiversitas dan fungsi ekosistem hutan.</p><p>Melalui riset dan advokasi, Kawungpitu berupaya mengidentifikasi dampak-dampak ini dan mengembangkan strategi adaptasi bersama masyarakat.</p>',
                    'en' => '<p>Climate change poses a serious threat to the preservation of tropical forests in Indonesia. Rising temperatures, changing rainfall patterns, and increased frequency of extreme climate events significantly impact forest biodiversity and ecosystem functions.</p><p>Through research and advocacy, Kawungpitu works to identify these impacts and develop adaptation strategies with communities.</p>',
                ],
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'view_count' => 210,
            ],
            [
                'category_id' => $komunitas->id,
                'title' => [
                    'id' => 'Kolaborasi Masyarakat dalam Restorasi Lahan Kritis',
                    'en' => 'Community Collaboration in Critical Land Restoration',
                ],
                'slug' => 'kolaborasi-masyarakat-restorasi-lahan',
                'excerpt' => [
                    'id' => 'Kisah sukses kolaborasi masyarakat dalam memulihkan lahan-lahan kritis menjadi produktif kembali.',
                    'en' => 'Success stories of community collaboration in restoring critical lands back to productivity.',
                ],
                'body' => [
                    'id' => '<p>Di Kabupaten Bogor, masyarakat bersama Kawungpitu berhasil merestorasi lebih dari 50 hektar lahan kritis menjadi lahan produktif dengan sistem agroforestri. Keberhasilan ini tidak lepas dari pendekatan partisipatif yang menempatkan masyarakat sebagai aktor utama perubahan.</p>',
                    'en' => '<p>In Bogor Regency, the community together with Kawungpitu successfully restored more than 50 hectares of critical land into productive land with agroforestry systems. This success is inseparable from the participatory approach that places the community as the main actor of change.</p>',
                ],
                'is_published' => true,
                'published_at' => now()->subDays(15),
                'view_count' => 67,
            ],
            [
                'category_id' => $kehutanan->id,
                'title' => [
                    'id' => 'Perhutanan Sosial: Peluang dan Tantangan',
                    'en' => 'Social Forestry: Opportunities and Challenges',
                ],
                'slug' => 'perhutanan-sosial-peluang-tantangan',
                'excerpt' => [
                    'id' => 'Membahas peluang dan tantangan implementasi program perhutanan sosial di tingkat tapak.',
                    'en' => 'Discussing opportunities and challenges of social forestry program implementation at the site level.',
                ],
                'body' => [
                    'id' => '<p>Program perhutanan sosial yang dicanangkan pemerintah memberikan akses legal bagi masyarakat untuk mengelola kawasan hutan negara. Namun, implementasinya di lapangan masih menghadapi berbagai tantangan.</p><p>Kawungpitu berperan sebagai fasilitator dalam mendampingi kelompok tani hutan untuk mengakses dan memanfaatkan skema perhutanan sosial secara optimal.</p>',
                    'en' => '<p>The social forestry program launched by the government provides legal access for communities to manage state forest areas. However, its implementation in the field still faces various challenges.</p><p>Kawungpitu serves as a facilitator in assisting forest farmer groups to access and utilize social forestry schemes optimally.</p>',
                ],
                'is_published' => true,
                'published_at' => now()->subDays(20),
                'view_count' => 125,
            ],
            [
                'category_id' => $edukasi->id,
                'title' => [
                    'id' => 'Mengenal Hasil Hutan Bukan Kayu (HHBK)',
                    'en' => 'Introduction to Non-Timber Forest Products (NTFP)',
                ],
                'slug' => 'mengenal-hhbk',
                'excerpt' => [
                    'id' => 'Panduan lengkap mengenal potensi hasil hutan bukan kayu dan manfaatnya bagi ekonomi masyarakat.',
                    'en' => 'A complete guide to understanding the potential of non-timber forest products and their benefits for community economy.',
                ],
                'body' => [
                    'id' => '<p>Hasil Hutan Bukan Kayu (HHBK) merupakan produk biologis selain kayu yang diperoleh dari hutan. HHBK memiliki potensi ekonomi yang besar dan dapat menjadi sumber penghidupan berkelanjutan bagi masyarakat sekitar hutan.</p><p>Contoh HHBK antara lain madu, rotan, getah, rempah-rempah, dan tanaman obat.</p>',
                    'en' => '<p>Non-Timber Forest Products (NTFP) are biological products other than timber obtained from forests. NTFPs have significant economic potential and can serve as sustainable livelihood sources for forest-adjacent communities.</p><p>Examples of NTFPs include honey, rattan, resin, spices, and medicinal plants.</p>',
                ],
                'is_published' => true,
                'published_at' => now()->subDays(25),
                'view_count' => 98,
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
