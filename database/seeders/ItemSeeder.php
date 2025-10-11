<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 items, each with 1-3 inventory records
        \App\Models\Item::factory(10)
            ->has(\App\Models\Inventory::factory()->count(rand(1, 3)))
            ->create();
    }
}
