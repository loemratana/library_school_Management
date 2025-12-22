<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Book::insert([
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'isbn' => '9780747532699',
                'author_id' => 1,
                'category_id' => 5,
                'publisher_id' => 4,
                'publish_year' => '1997',
                'description' => 'A young boy discovers he is a wizard.',
                'price' => 19.99,
                'quantity' => 50,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '1984',
                'isbn' => '9780451524935',
                'author_id' => 2,
                'category_id' => 1,
                'publisher_id' => 1,
                'publish_year' => '1949',
                'description' => 'A dystopian novel about totalitarianism.',
                'price' => 14.99,
                'quantity' => 30,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Shining',
                'isbn' => '9780307743657',
                'author_id' => 3,
                'category_id' => 4,
                'publisher_id' => 2,
                'publish_year' => '1977',
                'description' => 'A horror novel about a haunted hotel.',
                'price' => 16.99,
                'quantity' => 25,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Norwegian Wood',
                'isbn' => '9780375704079',
                'author_id' => 4,
                'category_id' => 1,
                'publisher_id' => 1,
                'publish_year' => '1987',
                'description' => 'A nostalgic novel about loss and sexuality.',
                'price' => 18.99,
                'quantity' => 20,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Murder on the Orient Express',
                'isbn' => '9780062693655',
                'author_id' => 5,
                'category_id' => 4,
                'publisher_id' => 2,
                'publish_year' => '1934',
                'description' => 'A classic mystery novel.',
                'price' => 12.99,
                'quantity' => 40,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
