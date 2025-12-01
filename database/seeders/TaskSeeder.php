<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Task::create([
            'title' => 'Morning Routine',
            'description' => 'Complete morning exercise and meditation',
            'date' => now(),
            'type' => 'daily',
        ]);

        \App\Models\Task::create([
            'title' => 'Weekly Planning',
            'description' => 'Plan tasks and goals for the upcoming week',
            'date' => now()->endOfWeek(),
            'type' => 'weekly',
        ]);

        \App\Models\Task::create([
            'title' => 'Monthly Review',
            'description' => 'Review monthly progress and set goals for next month',
            'date' => now()->endOfMonth(),
            'type' => 'monthly',
        ]);

        // Create 10 random tasks using the factory
        \App\Models\Task::factory(10)->create();
    }
}
