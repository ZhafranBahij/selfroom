<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = [
            ['name' => 'BCA', 'description' => 'Bank Central Asia'],
            ['name' => 'Dompet', 'description' => 'Dompet pribadi'],
            ['name' => 'Flazz', 'description' => 'Kartu Flazz BCA'],
            ['name' => 'Parkir', 'description' => 'Biaya parkir'],
            ['name' => 'Makan', 'description' => 'Biaya makan'],
            ['name' => 'Makan Keluarga', 'description' => 'Biaya makan keluarga'],
            ['name' => 'Otousan', 'description' => 'Uang saku untuk Otousan'],
            ['name' => 'Okaasan', 'description' => 'Uang saku untuk Okaasan'],
            ['name' => 'GZB', 'description' => 'Gozali Zaki Bahari'],
            ['name' => 'Hobi', 'description' => 'Pengeluaran untuk hobi'],
        ];

        foreach ($accounts as $account) {
            Account::firstOrCreate(
                ['name' => $account['name']],
                ['description' => $account['description']]
            );
        }
    }
}
