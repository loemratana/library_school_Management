<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    public function index()
    {
        //use Trend(last 7 day)
        $usageTrend = Borrow::select(
            DB::raw('DATE(borrow_date) as date'),
            DB::raw('count(*) as count')
        )->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(7)
            ->get();
        // Popular Books

        $popularBooks = Book::withCount('borrows')
            ->orderBy('borrows_count', 'desc')
            ->take(5)
            ->get();
        // Overdue Items

        $overdueItems = Borrow::with(['user', 'book'])->where('status', 'borrowed')->where('due_date', '<', now())->get();
        // Inventory Stats
        $inventoryStats = [
            'total' => Book::sum('quantity'),
            'missing' => Book::sum('missing_qty'),
            'damaged' => Book::sum('damaged_qty'),
            'borrowed' => Borrow::whereIn('status', ['borrowed', 'overdue'])->count(),
        ];
        return view('Admin.reports.index', compact('usageTrend', 'popularBooks', 'overdueItems', 'inventoryStats'));


    }
}
