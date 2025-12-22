<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BorrowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Borrow::insert([
            [
                'user_id' => 1,
                'book_id' => 1,
                'borrow_date' => now()->subDays(10),
                'due_date' => now()->addDays(4),
                'status' => 'borrowed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'book_id' => 2,
                'borrow_date' => now()->subDays(20),
                'due_date' => now()->subDays(6),
                'status' => 'overdue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'book_id' => 3,
                'borrow_date' => now()->subDays(5),
                'due_date' => now()->addDays(9),
                'status' => 'borrowed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
