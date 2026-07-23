@extends('frontend.master')
@section('title', 'My Dashboard - Libra')

@section('content')
<div class="dashboard-container">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 3rem;">
        <div>
            <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;">Welcome, {{ Auth::user()->name }}!</h1>
            <p style="color: var(--text-muted);">Manage your borrows, reservations, and account history.</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fa-solid fa-book-open"></i></div>
            <div class="stat-info">
                <h3>{{ $activeBorrows->count() }}</h3>
                <p>Active Borrows</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fa-solid fa-bookmark"></i></div>
            <div class="stat-info">
                <h3>{{ $reservations->count() }}</h3>
                <p>Pending Reservations</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon red"><i class="fa-solid fa-money-bill-wave"></i></div>
            <div class="stat-info">
                <h3 style="{{ $totalFines > 0 ? 'color: var(--danger);' : '' }}">${{ number_format($totalFines, 2) }}</h3>
                <p>Unpaid Fines</p>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        
        <!-- Main Area: Borrows & History -->
        <div>
            <div class="table-wrapper">
                <div class="table-header">
                    <h3 style="font-size: 1.25rem;">Current Borrows</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Borrowed On</th>
                            <th>Due Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activeBorrows as $borrow)
                            <tr>
                                <td>
                                    <div style="font-weight: 600;">{{ $borrow->book->title ?? 'Unknown Book' }}</div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($borrow->borrow_date)->format('M d, Y') }}</td>
                                <td>
                                    @php $isOverdue = \Carbon\Carbon::parse($borrow->due_date)->isPast(); @endphp
                                    <span style="{{ $isOverdue ? 'color: var(--danger); font-weight: 600;' : '' }}">
                                        {{ \Carbon\Carbon::parse($borrow->due_date)->format('M d, Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge {{ $isOverdue ? 'status-overdue' : 'status-borrowed' }}">
                                        {{ ucfirst($borrow->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 3rem;">
                                    You have no active borrowed books.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="table-wrapper">
                <div class="table-header">
                    <h3 style="font-size: 1.25rem;">Borrowing History</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Returned On</th>
                            <th>Fine Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowHistory as $borrow)
                            <tr>
                                <td>
                                    <div style="font-weight: 600;">{{ $borrow->book->title ?? 'Unknown Book' }}</div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($borrow->return_date)->format('M d, Y') }}</td>
                                <td>${{ number_format($borrow->fine_amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; color: var(--text-muted); padding: 3rem;">
                                    No past borrows found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div style="padding: 1rem;">
                    {{ $borrowHistory->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

        <!-- Sidebar Area: Reservations & Account -->
        <div>
            <div class="table-wrapper" style="margin-bottom: 2rem;">
                <div class="table-header">
                    <h3 style="font-size: 1.25rem;">My Reservations</h3>
                </div>
                <div style="padding: 1.5rem;">
                    @forelse($reservations as $res)
                        <div style="border-bottom: 1px solid var(--border); padding-bottom: 1rem; margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: flex-start;">
                            <div>
                                <div style="font-weight: 600; margin-bottom: 0.25rem;">{{ $res->book->title ?? 'Unknown Book' }}</div>
                                <div style="font-size: 0.85rem; color: var(--text-muted);">Placed on {{ $res->created_at->format('M d, Y') }}</div>
                                <span class="status-badge status-pending" style="display: inline-block; margin-top: 0.5rem; font-size: 0.75rem;">Pending</span>
                            </div>
                            <form action="{{ route('reserve.cancel', $res->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-secondary" style="padding: 0.25rem 0.75rem; font-size: 0.8rem; background: transparent; border-color: var(--danger); color: var(--danger);">Cancel</button>
                            </form>
                        </div>
                    @empty
                        <p style="color: var(--text-muted); text-align: center;">No active reservations.</p>
                    @endforelse
                </div>
            </div>

            <div class="table-wrapper">
                <div class="table-header">
                    <h3 style="font-size: 1.25rem;">Account Info</h3>
                </div>
                <div style="padding: 1.5rem;">
                    <div style="margin-bottom: 1rem;">
                        <span style="display: block; color: var(--text-muted); font-size: 0.85rem;">Email</span>
                        <div style="font-weight: 500;">{{ Auth::user()->email }}</div>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <span style="display: block; color: var(--text-muted); font-size: 0.85rem;">Member Since</span>
                        <div style="font-weight: 500;">{{ Auth::user()->created_at->format('M Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
