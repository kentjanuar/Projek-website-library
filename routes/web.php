<?php

use App\Http\Controllers\BookBorrowsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Models\Book;
use App\Models\Category;
use App\Http\Controllers\FinesController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::resource('/dashboard/books', BookController::class)->middleware('auth');

Route::get('/',function() {
    return view('dashboard.index' , [
        'books' => Book::latest()->get(),
        'categories' => Category::all()
    ]);
});

Route::get('/explore', function() {
    return view('dashboard.explore', [
        'books' => Book::filter(request(['search', 'category']))  // Filter berdasarkan request search dan category
                        ->latest()
                        ->paginate(6)
                        ->withQueryString(),  // Menambahkan query string agar pencarian tetap ada di URL
        'categories' => Category::all(),
    ]);
});


Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login'); // cek di Authenticate.php untuk liat kalau belum autentikasi redirect ke mana jadi butuh name('login) atau apapun yang di set

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::resource('dashboard/categories', CategoryController::class)->middleware('admin');

Route::resource('dashboard/users', UserController::class)->middleware('admin');

Route::get('/dashboard/bookBorrows', [BookBorrowsController::class,'index'])->middleware('auth');
Route::get('/dashboard/bookBorrows/borrow/{book}', [BookBorrowsController::class, 'borrow'])->middleware('auth');
Route::post('/dashboard/bookBorrows/borrow/{book}', [BookBorrowsController::class, 'store']);
Route::get('/dashboard/bookBorrows/admin', [BookBorrowsController::class, 'adminIndex'])->middleware('admin');
Route::put('/dashboard/bookBorrows/{book}/return', [BookBorrowsController::class, 'returnBook'])->name('returnBook');

Route::get('/dashboard/fines',[FinesController::class,'index'])->middleware('auth');
Route::get('/dashboard/fines/admin',[FinesController::class,'adminIndex'])->middleware('admin');
Route::put('/pay-fine/{fine}', [FinesController::class, 'payFine'])->name('payFine')->middleware('admin');
