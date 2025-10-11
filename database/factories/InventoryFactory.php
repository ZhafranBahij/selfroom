<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_id' => null, // Will be set when creating with Item model
            'location' => $this->faker->randomElement(['Warehouse A', 'Warehouse B', 'Storage Room 1', 'Storage Room 2']),
            'detail_location' => 'Shelf ' . $this->faker->randomLetter() . $this->faker->numberBetween(1, 10),
        ];
    }
}
