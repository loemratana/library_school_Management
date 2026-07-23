<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store($book_id)
    {
        $book = Book::findOrFail($book_id);
        
        if ($book->available_quantity > 0) {
            return back()->with('error', 'Book is currently available, you can borrow it directly.');
        }

        $existing = Reservation::where('user_id', Auth::id())
            ->where('book_id', $book_id)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return back()->with('error', 'You already have a pending reservation for this book.');
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'book_id' => $book_id,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Book reserved successfully. We will notify you when it becomes available.');
    }

    public function cancel($id)
    {
        $reservation = Reservation::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $reservation->update(['status' => 'cancelled']);
        
        return back()->with('success', 'Reservation cancelled successfully.');
    }
}
