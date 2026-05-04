<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => [
                    'id' => 'Apa itu Kawungpitu?',
                    'en' => 'What is Kawungpitu?',
                ],
                'answer' => [
                    'id' => '<p>Kawungpitu adalah perusahaan konsultan yang bergerak di bidang kehutanan dan lingkungan hidup. Kami berfokus pada pendampingan masyarakat dalam pengelolaan hutan berkelanjutan, edukasi lingkungan, dan pengembangan kapasitas lokal.</p>',
                    'en' => '<p>Kawungpitu is a consulting company engaged in forestry and environmental sectors. We focus on assisting communities in sustainable forest management, environmental education, and local capacity building.</p>',
                ],
                'sort_order' => 1,
            ],
            [
                'question' => [
                    'id' => 'Bagaimana cara berkolaborasi dengan Kawungpitu?',
                    'en' => 'How can I collaborate with Kawungpitu?',
                ],
                'answer' => [
                    'id' => '<p>Anda dapat menghubungi kami melalui halaman <strong>Kontak</strong> atau langsung mengirim email ke kawungpitu@gmail.com. Kami terbuka untuk kolaborasi dengan organisasi, lembaga pemerintah, komunitas, dan individu yang memiliki visi yang sama.</p>',
                    'en' => '<p>You can reach us through the <strong>Contact</strong> page or directly email us at kawungpitu@gmail.com. We are open to collaboration with organizations, government agencies, communities, and individuals who share the same vision.</p>',
                ],
                'sort_order' => 2,
            ],
            [
                'question' => [
                    'id' => 'Di mana lokasi kantor Kawungpitu?',
                    'en' => 'Where is the Kawungpitu office located?',
                ],
                'answer' => [
                    'id' => '<p>Kantor kami berlokasi di Jl. Mawar Raya No. 16 Lt. 2, Kelurahan Curugmekar, Kecamatan Bogor Barat, Kota Bogor 16113, Jawa Barat, Indonesia.</p>',
                    'en' => '<p>Our office is located at Jl. Mawar Raya No. 16, 2nd Floor, Curugmekar, West Bogor, Bogor City 16113, West Java, Indonesia.</p>',
                ],
                'sort_order' => 3,
            ],
            [
                'question' => [
                    'id' => 'Apa itu Lingkar Belajar Kawung (LBK)?',
                    'en' => 'What is Lingkar Belajar Kawung (LBK)?',
                ],
                'answer' => [
                    'id' => '<p>Lingkar Belajar Kawung (LBK) adalah program edukasi dan pelatihan dari Kawungpitu yang dirancang khusus untuk petani hutan dan masyarakat sekitar hutan. Program ini mencakup materi tentang pengelolaan hutan, agroforestri, dan kewirausahaan petani.</p>',
                    'en' => '<p>Lingkar Belajar Kawung (LBK) is an education and training program from Kawungpitu specifically designed for forest farmers and forest-adjacent communities. The program covers materials on forest management, agroforestry, and farmer entrepreneurship.</p>',
                ],
                'sort_order' => 4,
            ],
            [
                'question' => [
                    'id' => 'Apakah materi LBK bisa diakses secara gratis?',
                    'en' => 'Can LBK materials be accessed for free?',
                ],
                'answer' => [
                    'id' => '<p>Ya, sebagian besar materi LBK dapat diakses secara gratis melalui website kami. Beberapa materi juga tersedia dalam format PDF yang dapat diunduh.</p>',
                    'en' => '<p>Yes, most LBK materials can be accessed for free through our website. Some materials are also available in downloadable PDF format.</p>',
                ],
                'sort_order' => 5,
            ],
            [
                'question' => [
                    'id' => 'Layanan apa saja yang ditawarkan Kawungpitu?',
                    'en' => 'What services does Kawungpitu offer?',
                ],
                'answer' => [
                    'id' => '<p>Kawungpitu menawarkan tiga layanan utama:</p><ol><li><strong>Konsultasi Kehutanan</strong> — pendampingan teknis pengelolaan hutan</li><li><strong>Riset & Kajian</strong> — penelitian dan analisis kebijakan kehutanan</li><li><strong>Lingkar Belajar Kawung</strong> — program edukasi dan pelatihan</li></ol>',
                    'en' => '<p>Kawungpitu offers three main services:</p><ol><li><strong>Forestry Consulting</strong> — technical assistance in forest management</li><li><strong>Research & Studies</strong> — forestry policy research and analysis</li><li><strong>Lingkar Belajar Kawung</strong> — education and training programs</li></ol>',
                ],
                'sort_order' => 6,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
