<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with(['author', 'category', 'publisher']);

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('isbn', 'like', '%' . $search . '%')
                    ->orWhereHas('author', function ($q) use ($search) {
                        $q->where('FirstName', 'like', '%' . $search . '%')
                            ->orWhere('LastName', 'like', '%' . $search . '%');
                    });
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Filter by author
        if ($request->has('author') && $request->author != '') {
            $query->where('author_id', $request->author);
        }

        // Filter by publisher
        if ($request->has('publisher') && $request->publisher != '') {
            $query->where('publisher_id', $request->publisher);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Sort options
        $sortBy = $request->get('sort_by', 'latest');
        switch ($sortBy) {
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'oldest':
                $query->oldest();
                break;
            default:
                $query->latest();
        }

        $books = $query->paginate(10);

        // Get filter options
        $authors = Author::orderBy('FirstName', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        $publishers = Publisher::orderBy('name', 'ASC')->get();

        // Statistics for collections
        $totalBooks = Book::count();
        $activeBooks = Book::where('status', 1)->count();
        $totalBorrowed = 0; // Temporarily 0 as borrow feature is being rolled back
        $popularBooks = []; // Temporarily empty

        return view('Admin.book', compact(
            'books',
            'authors',
            'categories',
            'publishers',
            'totalBooks',
            'activeBooks',
            'totalBorrowed',
            'popularBooks'
        ));
    }

    public function collection(Request $request)
    {
        // Get popular books - temporarily just latest as popular uses borrows
        $popularBooks = Book::with(['author', 'category', 'publisher'])
            ->where('status', 1)
            ->take(8)
            ->get();

        // Get latest books
        $latestBooks = Book::with(['author', 'category', 'publisher'])
            ->where('status', 1)
            ->latest()
            ->take(8)
            ->get();

        // Get all books with search and filter for card view
        $query = Book::with(['author', 'category', 'publisher'])
            ->where('status', 1);

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('isbn', 'like', '%' . $search . '%')
                    ->orWhereHas('author', function ($q) use ($search) {
                        $q->where('FirstName', 'like', '%' . $search . '%')
                            ->orWhere('LastName', 'like', '%' . $search . '%');
                    });
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Filter by author
        if ($request->has('author') && $request->author != '') {
            $query->where('author_id', $request->author);
        }

        // Handle collection filter (popular/latest/all)
        $filter = $request->get('filter', 'all');

        if ($filter == 'latest') {
            $books = Book::with(['author', 'category', 'publisher'])
                ->where('status', 1)
                ->latest()
                ->paginate(12);
        } else {
            $books = $query->paginate(12);
        }

        // Get filter options
        $categories = Category::orderBy('name', 'ASC')->get();
        $authors = Author::orderBy('FirstName', 'ASC')->get();

        return view('Admin.book_collection', compact(
            'popularBooks',
            'latestBooks',
            'books',
            'categories',
            'authors'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author_id' => 'required',
            'category_id' => 'required',
            'publisher_id' => 'required',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $image_save = null;
        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/book_images/'), $name_gen);
            $image_save = 'upload/book_images/' . $name_gen;
        }

        Book::create([
            'title' => $request->title,
            'isbn' => $request->isbn,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'publisher_id' => $request->publisher_id,
            'publish_year' => $request->publish_year,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $image_save,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Book Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function update(Request $request)
    {
        $book_id = $request->id;
        $old_img = $request->old_image;

        $request->validate([
            'title' => 'required|max:255',
            'author_id' => 'required',
            'category_id' => 'required',
            'publisher_id' => 'required',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->file('image')) {
            if ($old_img && file_exists(public_path($old_img))) {
                unlink(public_path($old_img));
            }

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/book_images/'), $name_gen);
            $image_save = 'upload/book_images/' . $name_gen;

            Book::findOrFail($book_id)->update([
                'title' => $request->title,
                'isbn' => $request->isbn,
                'author_id' => $request->author_id,
                'category_id' => $request->category_id,
                'publisher_id' => $request->publisher_id,
                'publish_year' => $request->publish_year,
                'description' => $request->description,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'image' => $image_save,
            ]);
        } else {
            Book::findOrFail($book_id)->update([
                'title' => $request->title,
                'isbn' => $request->isbn,
                'author_id' => $request->author_id,
                'category_id' => $request->category_id,
                'publisher_id' => $request->publisher_id,
                'publish_year' => $request->publish_year,
                'description' => $request->description,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ]);
        }

        $notification = array(
            'message' => 'Book Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $img = $book->image;
        if ($img && file_exists(public_path($img))) {
            unlink(public_path($img));
        }

        $book->delete();

        $notification = array(
            'message' => 'Book Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function generateQr($id)
    {
        $book = Book::findOrFail($id);
        return view('Admin.book_qr', compact('book'));
    }
}
