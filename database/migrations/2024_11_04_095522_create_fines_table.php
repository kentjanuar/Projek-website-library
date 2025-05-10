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
        Schema::create('fines', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('borrow_id')->constrained('book_borrows'); // Foreign key ke tabel book_borrows
            $table->integer('amount'); // Jumlah denda
            $table->date('date_assigned'); // Tanggal denda diberikan
            $table->date('date_paid')->nullable(); // Tanggal denda dibayar, nullable karena bisa belum dibayar
            $table->string('status'); // Status denda (misalnya: 'unpaid' (0), 'paid' (1))
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};
