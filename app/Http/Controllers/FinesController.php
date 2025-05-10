<?php

namespace App\Http\Controllers;

use App\Models\Fines;
use Illuminate\Http\Request;
use App\Models\BookBorrows;
use Carbon\Carbon;

class FinesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Panggil fungsi untuk mengecek dan membuat denda sebelum menampilkan daftar fines
        $this->checkAndCreateFines();

        // Tampilkan fines yang ada untuk user yang sedang login
        $fines = Fines::whereHas('bookBorrow', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();

        return view('dashboard.fines.index', compact('fines'));
    }

    public function checkAndCreateFines()
    {
        // Ambil semua peminjaman yang overdue dan belum dikembalikan
        $overdueBorrows = BookBorrows::whereNull('return_date')
            ->where('due_date', '<', Carbon::now())
            ->get();

        foreach ($overdueBorrows as $borrow) {
            // Cek apakah sudah ada denda untuk peminjaman ini
            $existingFine = Fines::where('borrow_id', $borrow->id)->first();

            if (!$existingFine) {
                // Hitung jumlah hari overdue
                $overdueDays = Carbon::now()->diffInDays($borrow->due_date);
                $amount = $overdueDays * 50000;

                // Buat denda baru di tabel fines
                Fines::create([
                    'borrow_id' => $borrow->id,
                    'amount' => $amount,
                    'date_assigned' => Carbon::now(),
                    'status' => 'unpaid',
                ]);
            } else {
                // Update jumlah denda jika sudah ada tapi jumlah overdue berubah
                $overdueDays = Carbon::now()->diffInDays($borrow->due_date);
                $amount = $overdueDays * 50000;
                $existingFine->update(['amount' => $amount]);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function adminIndex()
    {
        // Tampilkan semua denda yang ada
        $fines = Fines::latest()->get();

        return view('dashboard.fines.admin', compact('fines'));
    }

    public function payFine($fineId)
{
    // Cari fine berdasarkan ID
    $fine = Fines::where('id', $fineId)->firstOrFail();

    // Pastikan status fine adalah 'unpaid'
    if ($fine->status !== 'unpaid') {
        return redirect()->back()->with('error', 'Fine has already been paid.');
    }

    // Update status fine menjadi 'paid'
    $fine->update([
        'status' => 'paid',
        'date_paid' => Carbon::now()
    ]);

    // Update status buku menjadi 0 (misalnya 0 berarti buku tersedia)
    $book = $fine->bookBorrow->book;
    $book->update([
        'status' => 0 // Status 0 berarti buku tersedia
    ]);

    // Update return_date di tabel BookBorrows menjadi sekarang
    $bookBorrow = $fine->bookBorrow;
    $bookBorrow->update([
        'return_date' => Carbon::now(),
        'status' => 1
    ]);

    // Redirect ke halaman yang sesuai dengan pesan sukses
    return redirect('/dashboard/fines/admin')->with('success', 'Fine has been paid and book has been returned.');
}

}
