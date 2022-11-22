<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'testuser',
            'email' => 'text@example.com',
            'role' => 'admin'
        ]);

        \App\Models\Board::factory()->create([
            'name' => 'testboard',
            'description' => 'testboard description'
        ]);
    }
}
