<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Borrow;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $activeBorrows = Borrow::with('book')
            ->where('user_id', $user->id)
            ->whereIn('status', ['borrowed', 'overdue'])
            ->get();
            
        $borrowHistory = Borrow::with('book')
            ->where('user_id', $user->id)
            ->where('status', 'returned')
            ->latest()
            ->paginate(5);
            
        $reservations = Reservation::with('book')
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->get();

        $totalFines = $user->total_outstanding_fines;

        return view('frontend.member.dashboard', compact('activeBorrows', 'borrowHistory', 'reservations', 'totalFines'));
    }
}
