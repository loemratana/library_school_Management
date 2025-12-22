<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('books')) {
            Schema::create('books', function (Blueprint $table) {
                $table->id('book_id');
                $table->string('title');
                $table->string('isbn')->nullable();

                $table->foreignId('author_id')->constrained('authors', 'AuthorID')->onDelete('cascade');
                $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
                $table->foreignId('publisher_id')->constrained('publishers', 'publisher_id')->onDelete('cascade');

                $table->string('publish_year')->nullable();
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->decimal('price', 8, 2)->nullable();
                $table->integer('status')->default(1);

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
