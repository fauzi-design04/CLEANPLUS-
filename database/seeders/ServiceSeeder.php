<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name' => 'Bersih-bersih Rumah Standar',
                'description' => 'Layanan kebersihan rumah secara menyeluruh termasuk menyapu, mengepel, membersihkan kamar mandi, dapur, ruang tamu, dan kamar tidur. Dilakukan oleh staff profesional CleanPlus Jambi dengan peralatan lengkap.',
                'price_per_hour' => 50000,
                'duration_hours' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Bersih-bersih Rumah Premium',
                'description' => 'Layanan kebersihan premium dengan perhatian khusus pada detail. Termasuk pembersihan jendela, perawatan furniture, dan area-area sulit dijangkau. Menggunakan bahan pembersih premium dan ramah lingkungan.',
                'price_per_hour' => 75000,
                'duration_hours' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Bersih-bersih Setelah Pesta',
                'description' => 'Layanan khusus untuk membersihkan rumah setelah acara atau pesta. Termasuk penanganan noda khusus, bau, dan pembersihan area-area yang terkena dampak acara. Tim khusus yang terlatih menangani situasi pasca-acara.',
                'price_per_hour' => 60000,
                'duration_hours' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Bersih-bersih Kantor',
                'description' => 'Layanan kebersihan untuk kantor dan ruang kerja. Termasuk area kerja, meeting room, pantry, dan area umum. Dilakukan di luar jam kerja untuk tidak mengganggu aktivitas bisnis.',
                'price_per_hour' => 55000,
                'duration_hours' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Pembersihan Karpet & Sofa',
                'description' => 'Layanan khusus untuk pembersihan karpet, sofa, dan furniture berlapis kain. Menggunakan mesin steam cleaner profesional untuk hasil yang maksimal dan higienis.',
                'price_per_hour' => 80000,
                'duration_hours' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Pembersihan Jendela & Kaca',
                'description' => 'Layanan pembersihan jendela, kaca, dan permukaan transparan lainnya. Termasuk bingkai jendela dan track-nya. Aman untuk berbagai jenis kaca dan jendela.',
                'price_per_hour' => 45000,
                'duration_hours' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}