<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VericationCodeMail;

use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalMembers = User::where('role', 'member')->count();
        $borrowedBooks = Borrow::whereIn('status', ['borrowed', 'overdue'])->count();
        $overdueBooks = Borrow::where('status', 'overdue')->count();

        // Available books (total quantity - borrowed/overdue)
        $totalQuantity = Book::sum('quantity');
        $availableBooks = max(0, $totalQuantity - $borrowedBooks);

        // Recent borrowing activity
        $recentBorrows = Borrow::with(['user', 'book'])->latest()->take(5)->get();

        // Chart 1: Monthly Borrowing Activity (Last 6 Months)
        $months = collect();
        $borrowsCount = collect();
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months->push($date->format('M'));
            $borrowsCount->push(Borrow::whereYear('borrow_date', $date->year)
                ->whereMonth('borrow_date', $date->month)
                ->count());
        }

        // Chart 2: Popular Books (Top 5)
        $popularBooks = Book::withCount('borrows')
            ->orderBy('borrows_count', 'desc')
            ->take(5)
            ->get();
        $popularBookTitles = $popularBooks->pluck('title');
        $popularBookCounts = $popularBooks->pluck('borrows_count');

        // Chart 3: Borrows vs Returns (This Month)
        $thisMonthBorrows = Borrow::whereMonth('borrow_date', now()->month)->count();
        $thisMonthReturns = Borrow::whereMonth('return_date', now()->month)->whereNotNull('return_date')->count();

        // Chart 4: Books by Category
        $categoryStats = Category::withCount('books')->get();
        $categoryNames = $categoryStats->pluck('name');
        $categoryBookCounts = $categoryStats->pluck('books_count');

        return view('Admin.index', compact(
            'totalBooks',
            'totalMembers',
            'borrowedBooks',
            'overdueBooks',
            'availableBooks',
            'recentBorrows',
            'months',
            'borrowsCount',
            'popularBookTitles',
            'popularBookCounts',
            'thisMonthBorrows',
            'thisMonthReturns',
            'categoryNames',
            'categoryBookCounts'
        ));
    }

    //
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    //loign

    public function AdminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        // Invalid credentials
        return redirect()->back()->withErrors(['email' => 'Invalid credentials provided.']);
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('Admin.admin_profile', compact('adminData'));
    }

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->role = $request->role;
        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            @unlink(public_path('upload/admin_images/' . $data->profile_image));
            $filename = date('YmdHi') . $file->getClientOriginalName();

            $file->move(public_path('upload/admin_images'), $filename);
            $data->profile_image = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Profile updated successfully',
            'type' => 'success',
        );

        return redirect()->back()->with($notification);
    }


    public function UserManagement()
    {
        $users = User::latest()->get();
        return view('Admin.user_management', compact('users'));
    }

    public function UserStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'role' => 'required',
        ]);

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'created_at' => now(),
        ]);

        $notification = array(
            'message' => 'User Created Successfully',
            'type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function UserUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        $notification = array(
            'message' => 'User Updated Successfully',
            'type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function UserDelete($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return redirect()->back()->with(['message' => 'You cannot delete yourself!', 'type' => 'error']);
        }
        $user->delete();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'type' => 'info',
        );

        return redirect()->back()->with($notification);
    }

    public function UserView($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.user_view', compact('user'));
    }
}
