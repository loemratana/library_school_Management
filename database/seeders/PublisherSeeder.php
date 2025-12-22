<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Publisher::insert([
            ['name' => 'Penguin Books', 'address' => '80 Strand, London', 'phone' => '123456789', 'email' => 'info@penguin.com', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'HarperCollins', 'address' => '195 Broadway, New York', 'phone' => '987654321', 'email' => 'contact@harpercollins.com', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Oxford University Press', 'address' => 'Great Clarendon Street, Oxford', 'phone' => '555666777', 'email' => 'sales@oup.com', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Scholastic', 'address' => '557 Broadway, New York', 'phone' => '111222333', 'email' => 'support@scholastic.com', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
