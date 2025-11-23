<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Core seeders
            RoleSeeder::class,
            UserSeeder::class,

            // Inventory related seeders
            LocationSeeder::class,
            ItemSeeder::class,

            // Accounting related seeders
            AccountSeeder::class,
            JournalSeeder::class,
            TransactionSeeder::class,
        ]);
    }
}
