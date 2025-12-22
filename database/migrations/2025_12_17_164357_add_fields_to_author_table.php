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
        Schema::table('authors', function (Blueprint $table) {
            if (!Schema::hasColumn('authors', 'FirstName')) {
                $table->string('FirstName', 50);
            }
            if (!Schema::hasColumn('authors', 'LastName')) {
                $table->string('LastName', 50);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->dropColumn('FirstName');
            $table->dropColumn('LastName');
        });
    }
};
