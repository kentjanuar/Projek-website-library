<?php

namespace Database\Seeders;
use App\Models\Book;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(5)->create();

        \App\Models\User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'alamat' => 'admin',
            'phone' => '1234567890',
            'is_admin' => true,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        

        \App\Models\Book::create([
            'title' => 'Pengantar Teknologi Informasi',
            'author' => 'Dr. Adhika Pramita',
            'published_year' => '2004',
            'publisher' => 'Penerbit Arjuna Indonesia',
            'description' => 'Pemahaman tentang teknologi informasi (TI) menjadi penting bagi setiap individu, baik di dalam maupun di luar bidang teknologi. Buku "Pengantar Teknologi Informasi" dirancang sebagai panduan untuk memperkenalkan konsep-konsep utama yang terkait dengan informasi teknologi. Buku ini memberikan gambaran menyeluruh mengenai berbagai aspek informasi teknologi, termasuk perangkat keras, perangkat lunak, media penyimpanan, jaringan komputer, internet, multimedia dan pemanfaatan teknologi informasi dalam kehidupan manusia.',
            'condition' => 'Good',
            'image' => 'book-images/pengantar_teknologi.jpg',
            'category_id' => 3,
        ]);

        \App\Models\Book::create([
            'title' => 'Harry Potter and the Half-Blood Prince',
            'author' => 'J. K. Rowling',
            'published_year' => '2005',
            'publisher' => 'British publisher Bloomsbury',
            'description' => "Harry Potter and the Half-Blood Prince is a fantasy novel written by the British author J. K. Rowling. It is the sixth novel in the Harry Potter series, and takes place during Harry Potter's sixth year at the wizard school Hogwarts. The novel reveals events from the early life of Lord Voldemort, and chronicles Harry's preparations for the final battle against him.",
            'condition' => 'In Repair',
            'image' => 'book-images/harrypotter.jpg',
            'category_id' => 1,
        ]);

        \App\Models\Book::create([
            'title' => 'The Lean Startup',
            'author' => 'Eric Ries',
            'published_year' => '2011',
            'publisher' => 'America publisher Bloomsbury',
            'description' => "The Lean Startup: How Today's Entrepreneurs Use Continuous Innovation to Create Radically Successful Businesses is a book by Eric Ries describing his proposed lean startup strategy for startup companies",
            'condition' => 'Broken',
            'image' => 'book-images/startup.png',
            'category_id' => 2,
        ]);

        Book::factory(7)->create();


        \App\Models\Category::create([
            'name' => 'Fiction',
            'description' => 'Fiction books contain stories that are not real but are imaginative.',
        ]);
        
        \App\Models\Category::create([
            'name' => 'Non-fiction',
            'description' => 'Non-fiction books contain information that is factual.',
        ]);
        
        \App\Models\Category::create([
            'name' => 'Technology',
            'description' => 'Technology books contain information about technology.',
        ]);
        

    }
}
