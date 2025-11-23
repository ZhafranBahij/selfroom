<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ...array_map(fn($i) => ['name' => "Rak $i", 'description' => "Rak nomor $i"], range(1, 11)),
            ['name' => 'Box kecil', 'description' => 'Kotak kecil'],
            ['name' => 'Tutup merah', 'description' => 'Wadah dengan tutup merah'],
            ['name' => 'Mini plastic box 1', 'description' => 'Plastik box mini 1'],
            ['name' => 'Mini plastic box 2', 'description' => 'Plastik box mini 2'],
            ['name' => 'Asbak', 'description' => 'Tas Asbak'],
            ['name' => 'Jean', 'description' => 'Totebag Jean Genshin Impact'],
        ];

        foreach ($locations as $location) {
            Location::firstOrCreate(
                ['name' => $location['name']],
                ['description' => $location['description']]
            );
        }
    }
}
