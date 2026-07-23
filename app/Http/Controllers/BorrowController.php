<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use App\Models\LibrarySetting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function booksCollection(Request $request)
    {
        $query = Book::with(['author', 'category']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('isbn', 'like', '%' . $search . '%')
                ->orWhereHas('author', function ($q) use ($search) {
                    $q->where('FirstName', 'like', '%' . $search . '%')
                        ->orWhere('LastName', 'like', '%' . $search . '%');
                });
        }

        $books = $query->latest('book_id')->paginate(12);

        // We also need users to populate the borrow modal
        $users = User::orderBy('name', 'asc')->get();
        $settings = LibrarySetting::pluck('value', 'key');

        return view('Admin.borrow_books', compact('books', 'users', 'settings'));
    }

    public function index(Request $request)
    {
        $query = Borrow::with(['user', 'book.author']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })->orWhereHas('book', function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $borrows = $query->latest()->paginate(10);

        $users = User::orderBy('name', 'asc')->get();
        // For available books, we might want to filter those with quantity > 0
        $books = Book::where('status', 1)->get();
        $settings = LibrarySetting::pluck('value', 'key');

        return view('Admin.borrow', compact('borrows', 'users', 'books', 'settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,book_id',
            'due_date' => 'nullable|date|after:today',
        ]);
        $book = Book::findOrFail($request->book_id);
        // check if book is available
        if ($book->available_quantity <= 0) {
            return redirect()->back()->with([
                'message' => 'Book is currently out of stock.',
                'alert-type' => 'error'
            ]);
        }
        // Check user limit from settings
        $maxBooks = (int) LibrarySetting::getVal('max_books_per_member', 5);

        $activeBorrowsCount = Borrow::where('user_id', $request->user_id)
            ->where('status', 'borrowed')
            ->count();

        if ($activeBorrowsCount >= $maxBooks) {
            return redirect()->back()->with([
                'message' => "User has reached the limit of $maxBooks borrowed books.",
                'alert-type' => 'error'
            ]);
        }

        $borrowDays = (int) LibrarySetting::getVal('max_borrow_days', 14);
        $dueDate = $request->due_date ?: Carbon::now()->addDays($borrowDays);

        Borrow::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => Carbon::now(),
            'due_date' => $dueDate,
            'status' => 'borrowed',
        ]);

        return redirect()->back()->with([
            'message' => 'Book borrowed successfully.',
            'alert-type' => 'success'
        ]);
    }
    /**
     * 2. RETURNS: Process return
     */

    public function returnBook($id)
    {
        $borrow = Borrow::findOrFail($id);
        $now = Carbon::now();
        $fineAmount = 0.00;

        // Calculate fine if overdue
        if ($now->gt($borrow->due_date)) {
            $daysOverdue = $now->diffInDays($borrow->due_date);
            $finePerDay = (float) LibrarySetting::getVal('fine_per_day', 1.00);
            $fineAmount = $daysOverdue * $finePerDay;
        }

        $borrow->update([
            'return_date' => $now,
            'status' => 'returned',
            'fine_amount' => $fineAmount,
            'fine_status' => $fineAmount > 0 ? 'unpaid' : 'paid',
        ]);

        $message = 'Book returned successfully.';
        if ($fineAmount > 0) {
            $message .= " A fine of $" . number_format($fineAmount, 2) . " has been recorded.";
        }

        return redirect()->back()->with([
            'message' => $message,
            'alert-type' => 'success'
        ]);
    }
    /**
     * 3. RENEWALS: Extend the due date
     */
    public function renewBook($id)
    {
        $borrow = Borrow::findOrFail($id);
        // Prevent renewal if already returned or overdue (optional policy)
        if ($borrow->status !== 'borrowed') {
            return redirect()->back()->with([
                'message' => 'Only active borrows can be renewed.',
                'alert-type' => 'warning'
            ]);
        }
        // Extend due date by 7 or 14 days
        $newDueDate = Carbon::parse($borrow->due_date)->addDays(14);
        $borrow->update(
            [
                'due_date' => $newDueDate

            ]

        );
        return redirect()->back()->with([
            'message' => 'Book renewed until ' . $newDueDate->format('Y-m-d'),
            'alert-type' => 'success'
        ]);
    }

    public function markFinePaid($id)
    {
        $borrow = Borrow::findOrFail($id);
        $borrow->update(['fine_status' => 'paid']);
        return redirect()->back()->with([
            'message' => 'Fine marked as paid successfully.',
            'alert-type' => 'success'
        ]);
    }

    public function reservations()
    {
        $reservations = \App\Models\Reservation::with(['user', 'book'])->latest()->paginate(10);
        return view('Admin.reservations', compact('reservations'));
    }
}
