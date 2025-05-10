<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    protected $with = ['category'];

    
    public function scopeFilter($query, array $filters)
    {
        // Filter berdasarkan pencarian judul dan penulis
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('author', 'like', '%' . $search . '%');
            });
        });
    
        // Filter berdasarkan kategori
        $query->when($filters['category'] ?? false, function($query, $category) {
            return $query->whereHas('category', function($query) use ($category) {
                $query->where('name', $category);
            });
        });


        // Filter berdasarkan kondisi buku
        $query->when($filters['condition'] ?? false, function ($query, $conditions) {
            $query->whereIn('condition', $conditions);
        });
    }
    
    
    

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
