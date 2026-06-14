<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CmsPage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@hnet.com'],
            [
                'name' => 'Admin HNet',
                'password' => Hash::make('admin12345'),
            ]
        );

        // Create CMS Pages
        $pages = [
            [
                'title' => 'Hero Banner',
                'slug' => 'hero-banner',
                'content' => json_encode([
                    'subheading' => 'Premium IT Services',
                    'heading' => 'Infrastruktur IT Handal & Aplikasi Custom',
                    'description' => 'Hnet Solution menghadirkan solusi integrasi sistem, jaringan berkecepatan tinggi, keamanan CCTV, dan pembuatan aplikasi bisnis kustom.',
                    'button_primary_text' => 'Mulai Sekarang',
                    'button_primary_link' => '#packages',
                    'button_secondary_text' => 'Konsultasi Gratis',
                    'button_secondary_link' => 'https://wa.me/6287781466447',
                    'slides' => [
                        ['image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1920&q=80', 'overlay' => 'rgba(15, 23, 42, 0.75)'],
                        ['image' => 'https://images.unsplash.com/photo-1558346490-a72e53ae2d4f?auto=format&fit=crop&w=1920&q=80', 'overlay' => 'rgba(30, 58, 138, 0.75)'],
                        ['image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1920&q=80', 'overlay' => 'rgba(17, 24, 39, 0.75)'],
                    ],
                ]),
            ],
            [
                'title' => 'Clients',
                'slug' => 'clients',
                'content' => json_encode([
                    'heading' => 'Dipercaya oleh Perusahaan Terkemuka',
                    'items' => [
                        ['name' => 'Client 1'],
                        ['name' => 'Client 2'],
                        ['name' => 'Client 3'],
                        ['name' => 'Client 4'],
                        ['name' => 'Client 5'],
                    ],
                ]),
            ],
            [
                'title' => 'Services',
                'slug' => 'services',
                'content' => json_encode([
                    'heading' => 'Layanan Unggulan Kami',
                    'items' => [
                        ['title' => 'App Development', 'description' => 'Pengembangan aplikasi berbasis Web menggunakan Laravel & PHP untuk otomatisasi bisnis anda.', 'icon' => 'fas fa-code'],
                        ['title' => 'Networking', 'description' => 'Instalasi LAN, Fiber Optik, konfigurasi Mikrotik, dan manajemen Bandwidth profesional.', 'icon' => 'fas fa-network-wired'],
                        ['title' => 'Storage & CCTV', 'description' => 'Solusi NAS (Network Attached Storage), CCTV Keamanan, dan Manajemen Data Center.', 'icon' => 'fas fa-hdd'],
                    ],
                ]),
            ],
            [
                'title' => 'Packages',
                'slug' => 'packages',
                'content' => json_encode([
                    'heading' => 'Pilihan Paket Kategori',
                    'subheading' => 'Pilih solusi yang paling tepat untuk skala bisnis Anda',
                    'items' => [
                        [
                            'title' => 'Basic Networking',
                            'features' => ['Pemasangan LAN', 'Konfigurasi CCTV', 'WiFi Management'],
                            'button_text' => 'Pilih Paket',
                            'button_link' => 'https://wa.me/6287781466447',
                            'is_popular' => false
                        ],
                        [
                            'title' => 'App Development',
                            'features' => ['Web-Based Laravel', 'Custom Business Logic', 'Admin Dashboard'],
                            'button_text' => 'Pilih Paket',
                            'button_link' => 'https://wa.me/6287781466447',
                            'is_popular' => true
                        ],
                        [
                            'title' => 'Enterprise Storage',
                            'features' => ['NAS Implementation', 'Data Center Setup', 'Backup Automation'],
                            'button_text' => 'Pilih Paket',
                            'button_link' => 'https://wa.me/6287781466447',
                            'is_popular' => false
                        ],
                    ],
                ]),
            ],
            [
                'title' => 'Gallery',
                'slug' => 'gallery',
                'content' => json_encode([
                    'heading' => 'Galeri Portofolio',
                    'items' => [
                        ['image' => ''],
                        ['image' => ''],
                        ['image' => ''],
                        ['image' => ''],
                    ],
                ]),
            ],
            [
                'title' => 'Contact',
                'slug' => 'contact',
                'content' => json_encode([
                    'heading' => 'Hnet Solution',
                    'description' => 'Hubungi kami hari ini untuk mendapatkan solusi infrastruktur IT dan aplikasi terbaik yang dirancang khusus untuk kebutuhan bisnis Anda.',
                    'email' => 'muhamadhabib.work@gmail.com',
                    'phone' => '+62 877-8146-6447',
                    'address' => 'Jakarta, Indonesia',
                ]),
            ],
        ];

        foreach ($pages as $page) {
            CmsPage::updateOrCreate(['slug' => $page['slug']], $page);
        }
    }
}