<?php

namespace App\Http\Controllers;

use App\Models\BookBorrows;
use Illuminate\Http\Request;
use App\Models\Book;

class BookBorrowsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.bookBorrows.index', [
            'bookBorrows' => BookBorrows::where('user_id', auth()->user()->id)
                                        ->whereNull('return_date')
                                        ->get()
        ]);
    }


    public function borrow(Book $book)
    {
        return view('dashboard.bookBorrows.borrow', [
            'book' => $book
        ]);
    }

    public function store() {
        $data = request()->validate([
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required',
            'due_date' => 'required'
        ]);

        $data['user_id'] = auth()->user()->id;
        $data['status'] = 0;

        BookBorrows::create($data);

        // Update status buku menjadi 1 setelah dipinjam
        Book::where('id', $data['book_id'])->update(['status' => 1]);

        return redirect('/explore')->with('success', 'Book borrowed successfully');
    }


    // public function adminIndex() {
    //     return view('dashboard.bookBorrows.adminIndex', [
    //         'bookBorrows' => BookBorrows::latest()->filter(request(['search', 'status']))->get()
    //     ]);
    // }

    public function adminIndex() {
        return view('dashboard.bookBorrows.adminIndex', [
            'bookBorrows' => BookBorrows::latest()->filter(request(['search', 'status', 'start_date', 'end_date']))->get()
        ]);
    }
    

    public function returnBook(BookBorrows $book)
{
    // Update the borrow record to set return date and mark as returned
    $book->update([
        'return_date' => now(),
        'status' => 1
    ]);

    // Set the book's status back to available
    Book::where('id', $book->book_id)->update(['status' => 0]);

    return redirect('/dashboard/bookBorrows/admin')->with('success', 'Book returned successfully');
}

}
