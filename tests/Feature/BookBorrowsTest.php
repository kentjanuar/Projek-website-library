<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\BookBorrows;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class BookBorrowsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_see_borrowed_books_list()
    {
        // Membuat pengguna
        $user = User::create([
            'name' => 'User',
            'username' => 'username',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'alamat' => 'Address',
            'phone' => '1234567890',
        ]);

        // Membuat buku
        $book = Book::create([
            'title' => 'Sample Book',
            'author' => 'Sample Author',
            'publisher' => 'Sample Publisher',
            'published_year' => 2024,
            'description' => 'Sample book description.',
            'condition' => 'New',
            'category_id' => 1,
            'status' => 0,
        ]);

        // Membuat peminjaman buku
        $borrowedBook = BookBorrows::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
            'status' => 0
        ]);

        // Login sebagai user
        $this->actingAs($user);

        // Mengakses halaman daftar peminjaman buku
        $response = $this->get('/dashboard/bookBorrows');

        // Memastikan halaman ditampilkan dengan benar dan mencakup peminjaman buku
        $response->assertStatus(200)
                 ->assertViewIs('dashboard.bookBorrows.index')
                 ->assertViewHas('bookBorrows', function ($bookBorrows) use ($borrowedBook) {
                     return $bookBorrows->contains('id', $borrowedBook->id);
                 });
    }

    /** @test */
    public function it_can_borrow_a_book()
    {
        // Membuat pengguna dan buku yang bisa dipinjam
        $user = User::create([
            'name' => 'User',
            'username' => 'username',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'alamat' => 'Address',
            'phone' => '1234567890',
        ]);
    
        $book = Book::create([
            'title' => 'Sample Book',
            'author' => 'Sample Author',
            'publisher' => 'Sample Publisher',
            'published_year' => 2024,
            'description' => 'Sample book description.',
            'condition' => 'New',
            'category_id' => 1,
            'status' => 0,
        ]);
    
        // Login sebagai user
        $this->actingAs($user);
    
        // Data peminjaman
        $borrowDate = now()->toDateString();  // Hanya mengambil tanggal (YYYY-MM-DD)
        $dueDate = now()->addDays(7)->toDateString();  // Hanya mengambil tanggal (YYYY-MM-DD)
    
        $data = [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrow_date' => $borrowDate,
            'due_date' => $dueDate
        ];
    
        // Mengirim request untuk meminjam buku
        $response = $this->post("/dashboard/bookBorrows/borrow/{$book->id}", $data);
    
        // Memastikan buku dipinjam dan status buku diubah
        $response->assertRedirect('/explore')
                ->assertSessionHas('success', 'Book borrowed successfully');
    
        // Memastikan data ada di database
        $this->assertDatabaseHas('book_borrows', [
            'book_id' => $book->id,
            'user_id' => $user->id,
            'borrow_date' => $borrowDate, // Periksa hanya tanggal, tanpa waktu
            'due_date' => $dueDate,       // Periksa hanya tanggal, tanpa waktu
        ]);
        $this->assertDatabaseHas('books', ['id' => $book->id, 'status' => 1]); // status berubah menjadi 1 (dipinjam)
    }
    

    /** @test */
    public function it_can_return_a_book()
    {
        // Membuat pengguna, buku dan peminjaman buku
        $user = User::create([
            'name' => 'User',
            'username' => 'username',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'alamat' => 'Address',
            'phone' => '1234567890',
        ]);

        $book = Book::create([
            'title' => 'Sample Book',
            'author' => 'Sample Author',
            'publisher' => 'Sample Publisher',
            'published_year' => 2024,
            'description' => 'Sample book description.',
            'condition' => 'New',
            'category_id' => 1,
            'status' => 1,
        ]);

        $borrowedBook = BookBorrows::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
            'status' => 0
        ]);

        // Login sebagai user
        $this->actingAs($user);

        // Mengirim request untuk mengembalikan buku
        $response = $this->put('/dashboard/bookBorrows/'.$borrowedBook->id.'/return');

        // Memastikan buku dikembalikan dan status buku diubah
        $response->assertRedirect('/dashboard/bookBorrows/admin')
                 ->assertSessionHas('success', 'Book returned successfully');
        
        $this->assertDatabaseHas('book_borrows', [
            'id' => $borrowedBook->id,
            'status' => 1,  // Status peminjaman berubah menjadi dikembalikan
            'return_date' => now()->toDateString()  // Tanggal pengembalian harus diupdate
        ]);
        
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'status' => 0  // Status buku dikembalikan dan menjadi tersedia
        ]);
    }
    
    public function test_valid_book_borrow()
    {
        $user = User::create([
            'name' => 'User',
            'username' => 'username',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'alamat' => 'Address',
            'phone' => '1234567890',
        ]);

        $category = Category::create([
            'name' => 'Sample Category',
            'description' => 'Sample category description.',
        ]);

        $book = Book::create([
            'title' => 'Sample Book',
            'author' => 'Sample Author',
            'publisher' => 'Sample Publisher',
            'published_year' => 2024,
            'description' => 'Sample book description.',
            'condition' => 'New',
            'category_id' => $category->id,
            'status' => 0, // Buku awalnya tersedia
        ]);

        // Lakukan post untuk meminjam buku
        $response = $this->actingAs($user)->post('/dashboard/bookBorrows/borrow/' . $book->id, [
            'book_id' => $book->id,
            'borrow_date' => now()->toDateString(),
            'due_date' => now()->addDays(7)->toDateString(),
        ]);
        

        // Cek apakah response berhasil (redirect)
        $response->assertRedirect('/explore');  // Sesuaikan dengan URL tujuan Anda

        // Verifikasi data yang disimpan di database
        $this->assertDatabaseHas('book_borrows', [
            'book_id' => $book->id,
            'user_id' => $user->id,
            'status' => 0,
        ]);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'status' => 1,  // Buku seharusnya statusnya 1 setelah dipinjam
        ]);
    }

    
}
