<?php

namespace Database\Seeders;

use App\Models\Pengajuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $customers = [
            'Andi Pratama', 'Budi Santoso', 'Citra Dewi', 'Dian Kusuma',
            'Eko Prasetyo', 'Fitriani', 'Gunawan Wibowo', 'Hendra Setiawan',
            'Indah Permata', 'Joko Widodo', 'Kartika Sari', 'Lukman Hakim',
            'Maya Anggraini', 'Nugroho Adi', 'Oktaviani Putri', 'Putra Ramadhan',
            'Rina Wati', 'Siti Nurhaliza', 'Taufik Rahman', 'Ulya Maghfiroh',
            'Vina Citra', 'Wahyu Nugroho', 'Yanti Susilawati', 'Zainal Abidin',
            'Angga Saputra', 'Bunga Citra Lestari', 'Dimas Aditya', 'Eka Puspita Sari',
            'Fajar Nugroho', 'Gita Puspitasari', 'Hadi Wijaya', 'Ira Novianti',
        ];

        $notes = [
            null, null, null, null,
            'Nasabah membutuhkan dana mendesak untuk renovasi rumah.',
            'Pengajuan untuk kebutuhan modal usaha warung makan.',
            'Pengajuan penggantian kendaraan lama.',
            'Nasabah sudah menjadi pelanggan setia selama 5 tahun.',
            'Dana digunakan untuk biaya pendidikan anak.',
            'Pengajuan untuk renovasi kamar kos.',
            'Kendaraan akan digunakan untuk keperluan operasional usaha.',
            'Pembelian kendaraan bekas dengan kondisi masih baik.',
            null, null,
            'Nasabah memiliki penghasilan tetap sebagai PNS.',
            'Pengajuan untuk keperluan investasi emas.',
            'Pembelian mobil untuk armada rental.',
            'Pengajuan untuk biaya pernikahan.',
            'Nasabah ingin mengganti sepeda motor yang sudah rusak.',
        ];

        foreach ($customers as $i => $name) {
            $loanType = ['sepeda_motor', 'mobil', 'multiguna'][$i % 3];
            $tenor = [6, 12, 18, 24][$i % 4];

            $loanAmounts = [
                'sepeda_motor' => match ($i % 5) {
                    0 => 8_500_000,
                    1 => 15_000_000,
                    2 => 22_000_000,
                    3 => 12_000_000,
                    default => 25_000_000,
                },
                'mobil' => match ($i % 5) {
                    0 => 85_000_000,
                    1 => 120_000_000,
                    2 => 175_000_000,
                    3 => 95_000_000,
                    default => 200_000_000,
                },
                'multiguna' => match ($i % 5) {
                    0 => 15_000_000,
                    1 => 35_000_000,
                    2 => 50_000_000,
                    3 => 75_000_000,
                    default => 100_000_000,
                },
            ];

            $income = match ($i % 4) {
                0 => 3_500_000,
                1 => 5_000_000,
                2 => 7_500_000,
                default => 12_000_000,
            };

            $status = match ($i % 7) {
                0, 1, 2, 3 => 'pending',
                4, 5 => 'disetujui',
                default => 'ditolak',
            };

            $daysAgo = match ($i % 8) {
                0 => 0,
                1 => 1,
                2 => 2,
                3 => 5,
                4 => 8,
                5 => 12,
                6 => 20,
                default => 30,
            };

            Pengajuan::create([
                'customer_name' => $name,
                'loan_type' => $loanType,
                'loan_amount' => $loanAmounts[$loanType],
                'tenor' => $tenor,
                'monthly_income' => $income,
                'notes' => $notes[$i % count($notes)],
                'status' => $status,
                'created_at' => now()->subDays($daysAgo)->subHours(rand(0, 12)),
            ]);
        }
    }
}
