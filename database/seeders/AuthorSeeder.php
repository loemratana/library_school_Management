<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Author::insert([
            ['FirstName' => 'J.K.', 'LastName' => 'Rowling', 'created_at' => now(), 'updated_at' => now()],
            ['FirstName' => 'George', 'LastName' => 'Orwell', 'created_at' => now(), 'updated_at' => now()],
            ['FirstName' => 'Stephen', 'LastName' => 'King', 'created_at' => now(), 'updated_at' => now()],
            ['FirstName' => 'Haruki', 'LastName' => 'Murakami', 'created_at' => now(), 'updated_at' => now()],
            ['FirstName' => 'Agatha', 'LastName' => 'Christie', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
