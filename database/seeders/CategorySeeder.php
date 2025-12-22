<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::insert([
            ['name' => 'Fiction', 'description' => 'Literary works that are based on imagination.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Science', 'description' => 'Scientific literature and journals.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'History', 'description' => 'Books about past events and civilizations.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mystery', 'description' => 'Stories involving suspense and problem-solving.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fantasy', 'description' => 'Stories with supernatural or mythical elements.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
