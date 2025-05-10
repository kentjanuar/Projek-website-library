<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // if(request('category')) {
    //     //     Category::firstWhere('name', request('category'));
    //     // }

    //     return view('dashboard.books.index', [
    //         'books' => Book::latest()->filter(request(['search','category']))->get(),
    //         'categories' => Category::all(),  
    //     ]);       
    // }

    public function index()
    {
        return view('dashboard.books.index', [
            'books' => Book::latest()->filter(request(['search', 'category', 'condition']))->get(),
            'categories' => Category::all(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('dashboard.books.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
            // Validasi input
        $validatedData = $r->validate([
            'title' => 'required|min:1',
            'author' => 'required|string|min:3|max:100', // Menambahkan validasi untuk author
            'publisher' => 'required|string|max:255', // Menambahkan validasi untuk publisher
            'published_year' => 'required|integer|digits:4', // Validasi tahun terbit harus 4 digit
            'description' => 'required', // Menambahkan validasi untuk deskripsi
            'condition' => 'required|in:Good,Broken,In Repair', // Validasi untuk kondisi buku
            'category_id' => 'required', // Validasi untuk kategori
            'image' => 'image|file|max:2048' // Validasi untuk gambar (opsional)
        ]);

        if($r->file('image')) {
            $validatedData['image'] = $r->file('image')->store('book-images');
        }

        // Membuat buku baru berdasarkan data yang divalidasi
        Book::create($validatedData);

        // Mengarahkan kembali ke daftar buku
        return redirect('/dashboard/books')->with('success', 'Book has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('dashboard.books.show', [
            'book' => $book,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('dashboard.books.edit', [
            'book' => $book,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, Book $book)
    {
        $rules = [
            'title' => 'required|min:3',
            'author' => 'required|string|max:255', // Menambahkan validasi untuk author
            'publisher' => 'required|string|max:255', // Menambahkan validasi untuk publisher
            'published_year' => 'required|integer|digits:4', // Validasi tahun terbit harus 4 digit
            'description' => 'required', // Menambahkan validasi untuk deskripsi
            'condition' => 'required|in:Good,Broken,In Repair', // Validasi untuk kondisi buku
            'category_id' => 'required', // Validasi untuk kategori
            'image' => 'image|file|max:2048' // Validasi untuk gambar (opsional)
        ];

        $validatedData = $r->validate($rules);

        if($r->file('image')) {

            if($r->oldImage){
                Storage::delete($r->oldImage);
            }    
            $validatedData['image'] = $r->file('image')->store('book-images');
        }

        // Membuat buku baru berdasarkan data yang divalidasi
        Book::where('id', $book->id)
            ->update($validatedData);

        // Mengarahkan kembali ke daftar buku
        return redirect('/dashboard/books')->with('success', 'Book has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if($book->image) {
            Storage::delete($book->image);
        }

        Book::destroy($book->id);

        return redirect('/dashboard/books')->with('success', 'Book has been deleted.');
    }
}
