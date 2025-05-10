<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookBorrows extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters) {
        // Filter by search term in 'title' or 'author'
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                // Pencarian berdasarkan judul buku
                $query->whereHas('book', function($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                })
                // Pencarian berdasarkan nama pengguna
                ->orWhereHas('user', function($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            });
        });
        
    
        // Filter by 'status' directly on the bookBorrows table
        $query->when(isset($filters['status']), function($query) use ($filters) {
            return $query->where('status', $filters['status']);
        });



        // Filter by borrow_date range
        $query->when($filters['start_date'] ?? false, function($query, $startDate) use ($filters) {
            $endDate = $filters['end_date'] ?? null;
            if ($endDate) {
                $query->whereBetween('borrow_date', [$startDate, $endDate]);
            } else {
                $query->where('borrow_date', '>=', $startDate);
            }
        });

    }

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function fines()
    {
        return $this->hasOne(Fines::class, 'borrow_id', 'id_peminjaman');
    }
}
