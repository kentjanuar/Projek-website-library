<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_borrows', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('book_id'); // Foreign key to books
            $table->foreignId('user_id'); // Foreign key to members
            $table->date('borrow_date');
            $table->date('due_date');
            $table->date('return_date')->nullable(); // Nullable since it may not be returned yet
            $table->boolean('status')->default(0); // 0 for not returned, 1 for returned
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_borrows');
    }
};
