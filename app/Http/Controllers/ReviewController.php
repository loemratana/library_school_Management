<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Review;
use App\Models\Borrow;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $book_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000'
        ]);

        // Check if user has ever borrowed this book
        $hasBorrowed = Borrow::where('user_id', Auth::id())
            ->where('book_id', $book_id)
            ->exists();

        if (!$hasBorrowed) {
            return back()->with('error', 'You can only review books you have borrowed.');
        }

        Review::updateOrCreate(
            ['user_id' => Auth::id(), 'book_id' => $book_id],
            ['rating' => $request->rating, 'review' => $request->review, 'approved' => true]
        );

        return back()->with('success', 'Thank you for your review!');
    }
}
