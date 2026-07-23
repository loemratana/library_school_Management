<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Category;

class FrontendController extends Controller
{
    public function index()
    {
        $featuredBooks = Book::with('author')->latest('book_id')->take(6)->get();
        $categories = Category::all();
        return view('frontend.home', compact('featuredBooks', 'categories'));
    }

    public function catalog(Request $request)
    {
        $query = Book::with(['author', 'category']);
        
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $books = $query->paginate(12);
        $categories = Category::all();
        
        return view('frontend.catalog', compact('books', 'categories'));
    }

    public function bookDetails($id)
    {
        $book = Book::with(['author', 'category', 'reviews.user', 'borrows'])->findOrFail($id);
        $relatedBooks = Book::where('category_id', $book->category_id)->where('book_id', '!=', $id)->take(4)->get();
        return view('frontend.book_details', compact('book', 'relatedBooks'));
    }
}
