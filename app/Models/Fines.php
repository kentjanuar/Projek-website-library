<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Fines extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Accessor untuk menghitung denda berdasarkan overdue
    public function getCalculatedAmountAttribute()
    {
        // Ambil data book borrow terkait
        $bookBorrow = $this->bookBorrow;

        // Jika buku belum dikembalikan dan sudah melewati due_date
        if ($bookBorrow && !$bookBorrow->return_date && Carbon::now()->gt($bookBorrow->due_date)) {
            $overdueDays = Carbon::now()->diffInDays($bookBorrow->due_date);
            return $overdueDays * 50000;
        }

        // Jika tidak terlambat, denda tetap atau 0
        return $this->amount;
    }

    public function scopeByUser($query, $userId)
    {
        return $query->whereHas('bookBorrow', function($query) use ($userId) {
            $query->where('user_id', $userId);
        });
    }

    public function bookBorrow()
    {
        return $this->belongsTo(BookBorrows::class, 'borrow_id');
    }
}
