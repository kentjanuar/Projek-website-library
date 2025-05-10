<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Membuat user untuk autentikasi
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'username' => 'testuser',
            'alamat' => 'Jl. Raya No. 1',
            'phone' => '081234567890',
            'password' => bcrypt('password')
        ]);

        // Membuat kategori secara manual
        Category::create(['name' => 'Fiction' , 'description' => 'Fiction books']);
        Category::create(['name' => 'Non-Fiction' , 'description' => 'Non-Fiction books']);
        Category::create(['name' => 'Technology' , 'description' => 'Technology books']);
        
        // Autentikasi sebelum setiap test
        $this->actingAs($this->user);
    }

    /** @test */
    // public function it_can_display_a_list_of_books()
    // {
    //     // Menambahkan buku secara manual
    //     $books = Book::create([
    //         'title' => 'Book One',
    //         'author' => 'Author One',
    //         'publisher' => 'Publisher One',
    //         'published_year' => 2020,
    //         'description' => 'A book description.',
    //         'condition' => 'Good',
    //         'category_id' => 1
    //     ]);
        
    //     $books = Book::create([
    //         'title' => 'Book Two',
    //         'author' => 'Author Two',
    //         'publisher' => 'Publisher Two',
    //         'published_year' => 2021,
    //         'description' => 'Another book description.',
    //         'condition' => 'Excellent',
    //         'category_id' => 2
    //     ]);

    //     $response = $this->get('/dashboard/books');

    //     $response->assertStatus(200)
    //              ->assertViewIs('dashboard.books.index')
    //              ->assertViewHas('books', $books);
    // }

    /** @test */
    public function it_can_create_a_new_book()
    {
        Storage::fake('public');
        $category = Category::first();

        $data = [
            'title' => 'New Book',
            'author' => 'John Doe',
            'publisher' => 'Publisher Inc.',
            'published_year' => 2023,
            'description' => 'A sample book.',
            'condition' => 'Good',
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image('book.jpg')
        ];

        $response = $this->post('/dashboard/books', $data);

        $response->assertRedirect('/dashboard/books');
        $this->assertDatabaseHas('books', [
            'title' => 'New Book',
            'author' => 'John Doe',
        ]);

        $this->assertTrue(Storage::disk('public')->exists('book-images/' . $data['image']->hashName()));
    }

    /** @test */
    public function it_cannot_create_a_book_with_missing_fields()
    {
        Storage::fake('public');
        $category = Category::first();

        // Test case: missing title
        $data = [
            'author' => 'John Doe',
            'publisher' => 'Publisher Inc.',
            'published_year' => 2023,
            'description' => 'A sample book.',
            'condition' => 'Good',
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image('book.jpg')
        ];

        $response = $this->post('/dashboard/books', $data);
        $response->assertSessionHasErrors('title');

        // Test case: missing author
        $data = [
            'title' => 'New Book',
            'publisher' => 'Publisher Inc.',
            'published_year' => 2023,
            'description' => 'A sample book.',
            'condition' => 'Good',
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image('book.jpg')
        ];

        $response = $this->post('/dashboard/books', $data);
        $response->assertSessionHasErrors('author');

        // Test case: missing publisher
        $data = [
            'title' => 'New Book',
            'author' => 'John Doe',
            'published_year' => 2023,
            'description' => 'A sample book.',
            'condition' => 'Good',
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image('book.jpg')
        ];

        $response = $this->post('/dashboard/books', $data);
        $response->assertSessionHasErrors('publisher');

        // Test case: missing published_year
        $data = [
            'title' => 'New Book',
            'author' => 'John Doe',
            'publisher' => 'Publisher Inc.',
            'description' => 'A sample book.',
            'condition' => 'Good',
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image('book.jpg')
        ];

        $response = $this->post('/dashboard/books', $data);
        $response->assertSessionHasErrors('published_year');

        // Test case: missing description
        $data = [
            'title' => 'New Book',
            'author' => 'John Doe',
            'publisher' => 'Publisher Inc.',
            'published_year' => 2023,
            'condition' => 'Good',
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image('book.jpg')
        ];

        $response = $this->post('/dashboard/books', $data);
        $response->assertSessionHasErrors('description');

        // Test case: missing condition
        $data = [
            'title' => 'New Book',
            'author' => 'John Doe',
            'publisher' => 'Publisher Inc.',
            'published_year' => 2023,
            'description' => 'A sample book.',
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image('book.jpg')
        ];

        $response = $this->post('/dashboard/books', $data);
        $response->assertSessionHasErrors('condition');
    }


    /** @test */
    public function it_cannot_create_a_book_with_invalid_image_type()
    {
        Storage::fake('public');
        $category = Category::first();

        $data = [
            'title' => 'New Book',
            'author' => 'John Doe',
            'publisher' => 'Publisher Inc.',
            'published_year' => 2023,
            'description' => 'A sample book.',
            'condition' => 'Good',
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->create('book.pdf', 100) // Invalid file type
        ];

        $response = $this->post('/dashboard/books', $data);
        $response->assertSessionHasErrors('image');
    }


    /** @test */
    public function it_cannot_create_a_book_with_invalid_author_length()
    {
        // Validasi dengan panjang 2 karakter (kurang dari 3)
        $data = [
            'title' => 'Sample Book',
            'author' => 'Jo', // 2 karakter
            'publisher' => 'Publisher Inc.',
            'published_year' => 2023,
            'description' => 'A sample book.',
            'condition' => 'Good',
            'category_id' => 1,
            'image' => UploadedFile::fake()->image('book.jpg')
        ];
        $response = $this->post('/dashboard/books', $data);
        $response->assertSessionHasErrors('author');

        // Validasi dengan panjang 3 karakter (tepat minimum)
        $data['author'] = 'John'; // 3 karakter
        $response = $this->post('/dashboard/books', $data);
        $response->assertSessionHasNoErrors();

        // Validasi dengan panjang 100 karakter (tepat maksimum)
        $data['author'] = str_repeat('J', 100); // 100 karakter
        $response = $this->post('/dashboard/books', $data);
        $response->assertSessionHasNoErrors();

        // Validasi dengan panjang 101 karakter (lebih dari maksimum)
        $data['author'] = str_repeat('J', 101); // 101 karakter
        $response = $this->post('/dashboard/books', $data);
        $response->assertSessionHasErrors('author');

        // Validasi dengan panjang 0 karakter (kosong)
        $data['author'] = ''; // Kosong
        $response = $this->post('/dashboard/books', $data);
        $response->assertSessionHasErrors('author');
    }

    /** @test */
    // public function test_it_can_show_a_book()
    // {
    //     // Buat kategori terlebih dahulu
    //     $category = Category::create(['name' => 'Fiction' , 'description' => 'Fiction books']);
        
    //     // Buat buku dengan category_id yang valid
    //     $book = Book::create([
    //         'title' => 'Sample Book',
    //         'author' => 'Sample Author',
    //         'publisher' => 'Sample Publisher',
    //         'published_year' => 2024,
    //         'description' => 'Sample book description.',
    //         'condition' => 'New',
    //         'category_id' => $category->id,
    //     ]);

    //     // Kirim request untuk melihat halaman buku
    //     $response = $this->get("/dashboard/books/{$book->id}");

    //     // Periksa status dan pastikan view berisi data buku
    //     $response->assertStatus(200)
    //              ->assertViewIs('dashboard.books.show')
    //              ->assertViewHas('book', $book);
    // }

    /** @test */
    // public function it_can_update_a_book()
    // {
    //     // Membuat buku dan kategori
    //     $book = Book::create([
    //         'title' => 'Old Title',
    //         'author' => 'Old Author',
    //         'publisher' => 'Old Publisher',
    //         'published_year' => 2020,
    //         'description' => 'Old description',
    //         'condition' => 'Used',
    //         'category_id' => 1,
    //     ]);
        
    //     $category = Category::first();

    //     $data = [
    //         'title' => 'Updated Title',
    //         'author' => 'Updated Author',
    //         'publisher' => 'Updated Publisher',
    //         'published_year' => 2025,
    //         'description' => 'Updated Description',
    //         'condition' => 'In Repair',
    //         'category_id' => $category->id,
    //     ];

    //     $response = $this->put("/dashboard/books/{$book->id}", $data);

    //     $response->assertRedirect('/dashboard/books');
    //     $this->assertDatabaseHas('books', [
    //         'id' => $book->id,
    //         'title' => 'Updated Title',
    //     ]);
    // }

    /** @test */
    // public function it_can_delete_a_book()
    // {
    //     Storage::fake('public');
        
    //     $book = Book::create([
    //         'title' => 'Book to Delete',
    //         'author' => 'Author to Delete',
    //         'publisher' => 'Publisher to Delete',
    //         'published_year' => 2022,
    //         'description' => 'Description of book to delete',
    //         'condition' => 'Damaged',
    //         'category_id' => 2,
    //         'image' => 'book-images/example.jpg'
    //     ]);

    //     $response = $this->delete("/dashboard/books/{$book->id}");

    //     $response->assertRedirect('/dashboard/books');
    //     $this->assertDatabaseMissing('books', ['id' => $book->id]);

    //     $this->assertFalse(Storage::disk('public')->exists('book-images/example.jpg'));
    // }


}
