<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('library_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('value');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Seed initial settings
        DB::table('library_settings')->insert([
            ['key' => 'max_books_per_member', 'value' => '5', 'description' => 'Maximum number of books a member can borrow at once', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'max_borrow_days', 'value' => '14', 'description' => 'Maximum days a member can keep a book', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'fine_per_day', 'value' => '1.00', 'description' => 'Fine amount per day for overdue books (USD)', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_settings');
    }
};
