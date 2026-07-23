<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Review;
use App\Models\Reservation;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $this->command->info('Seeding Users...');
        $users = [];
        for ($i = 0; $i < 100; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'member',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        User::insert($users);

        $this->command->info('Seeding Authors...');
        $authors = [];
        for ($i = 0; $i < 100; $i++) {
            $authors[] = [
                'FirstName' => $faker->firstName,
                'LastName' => $faker->lastName,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Author::insert($authors);

        $this->command->info('Seeding Categories...');
        $categories = [];
        for ($i = 0; $i < 100; $i++) {
            $categories[] = [
                'name' => $faker->unique()->word . ' ' . $faker->word,
                'description' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Category::insert($categories);

        $this->command->info('Seeding Publishers...');
        $publishers = [];
        for ($i = 0; $i < 100; $i++) {
            $publishers[] = [
                'name' => $faker->company,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Publisher::insert($publishers);

        $this->command->info('Seeding Books...');
        $authorIds = Author::pluck('AuthorID')->toArray();
        $categoryIds = Category::pluck('id')->toArray();
        $publisherIds = Publisher::pluck('publisher_id')->toArray();
        
        $books = [];
        for ($i = 0; $i < 100; $i++) {
            $books[] = [
                'title' => $faker->sentence(3),
                'isbn' => $faker->isbn13,
                'author_id' => $faker->randomElement($authorIds),
                'category_id' => $faker->randomElement($categoryIds),
                'publisher_id' => $faker->randomElement($publisherIds),
                'publish_year' => $faker->year,
                'quantity' => $faker->numberBetween(1, 20),
                'available_quantity' => $faker->numberBetween(1, 20),
                'price' => $faker->randomFloat(2, 5, 100),
                'description' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Book::insert($books);

        $this->command->info('Seeding Borrows...');
        $userIds = User::where('role', 'member')->pluck('id')->toArray();
        $bookIds = Book::pluck('book_id')->toArray();
        
        $borrows = [];
        for ($i = 0; $i < 100; $i++) {
            $borrows[] = [
                'user_id' => $faker->randomElement($userIds),
                'book_id' => $faker->randomElement($bookIds),
                'borrow_date' => $faker->dateTimeBetween('-2 months', 'now'),
                'due_date' => $faker->dateTimeBetween('-1 month', '+1 month'),
                'status' => $faker->randomElement(['borrowed', 'returned', 'overdue']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Borrow::insert($borrows);

        $this->command->info('Seeding Reviews...');
        $reviews = [];
        for ($i = 0; $i < 100; $i++) {
            $reviews[] = [
                'user_id' => $faker->randomElement($userIds),
                'book_id' => $faker->randomElement($bookIds),
                'rating' => $faker->numberBetween(1, 5),
                'review' => $faker->sentence,
                'approved' => $faker->boolean(80),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Review::insert($reviews);

        $this->command->info('Seeding Reservations...');
        $reservations = [];
        for ($i = 0; $i < 100; $i++) {
            $reservations[] = [
                'user_id' => $faker->randomElement($userIds),
                'book_id' => $faker->randomElement($bookIds),
                'status' => $faker->randomElement(['pending', 'fulfilled', 'cancelled']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Reservation::insert($reservations);
        
        $this->command->info('Database seeded successfully with 100 records per table!');
    }
}
