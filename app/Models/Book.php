<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Borrow;

class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'book_id';
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'AuthorID');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id', 'publisher_id');
    }

    public function getAvailableQuantityAttribute()
    {
        $borrowedCount = Borrow::where('book_id', $this->book_id)
            ->whereIn('status', ['borrowed', 'overdue'])
            ->count();
        return max(0, $this->quantity - $borrowedCount);
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class, 'book_id', 'book_id');
    }
}
