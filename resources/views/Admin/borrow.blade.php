@extends('Admin.admin_master')

@section('Admin')
    <style>
        .mini-stat {
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .mini-stat:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .avatar-sm {
            height: 2.5rem;
            width: 2.5rem;
        }

        .avatar-title {
            align-items: center;
            display: flex;
            font-size: 1rem;
            height: 100%;
            justify-content: center;
            width: 100%;
        }

        .table> :not(caption)>*>* {
            padding: 1rem 0.75rem;
        }

        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
        }
    </style>
    <section class="page-content">
        <div class="container-fluid mt-5">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Page Title -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Borrow Management</h4>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#borrowModal">
                                    <i class="fas fa-plus me-2"></i>Borrow Book
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <!-- <div class="row mb-4">
                                            <div class="col-md-3">
                                                <div class="card mini-stat text-white"
                                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                    <div class="card-body">
                                                        <div class="mb-2">
                                                            <i class="fas fa-book-reader float-end" style="font-size: 2rem; opacity: 0.5;"></i>
                                                        </div>
                                                        <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Total Borrows</h5>
                                                        <h4 class="fw-medium font-size-24">{{ App\Models\Borrow::count() }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card mini-stat text-white"
                                                    style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                                    <div class="card-body">
                                                        <div class="mb-2">
                                                            <i class="fas fa-book-open float-end" style="font-size: 2rem; opacity: 0.5;"></i>
                                                        </div>
                                                        <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Active Borrows</h5>
                                                        <h4 class="fw-medium font-size-24">{{ App\Models\Borrow::where('status', 'borrowed')->count() }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card mini-stat text-white"
                                                    style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                                    <div class="card-body">
                                                        <div class="mb-2">
                                                            <i class="fas fa-check-circle float-end" style="font-size: 2rem; opacity: 0.5;"></i>
                                                        </div>
                                                        <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Returned</h5>
                                                        <h4 class="fw-medium font-size-24">{{ App\Models\Borrow::where('status', 'returned')->count() }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card mini-stat text-white"
                                                    style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                                                    <div class="card-body">
                                                        <div class="mb-2">
                                                            <i class="fas fa-exclamation-triangle float-end" style="font-size: 2rem; opacity: 0.5;"></i>
                                                        </div>
                                                        <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Overdue</h5>
                                                        <h4 class="fw-medium font-size-24">{{ App\Models\Borrow::where('status', 'overdue')->count() }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->

                    <!-- Filters & Search Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.borrows') }}" class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Search</label>
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Search by user or book name..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="">All Status</option>
                                        <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>
                                            Borrowed
                                        </option>
                                        <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>
                                            Returned
                                        </option>
                                        <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Overdue
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="fas fa-search me-1"></i>Filter
                                    </button>
                                    <a href="{{ route('admin.borrows') }}" class="btn btn-secondary">
                                        <i class="fas fa-redo me-1"></i>Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Borrows Table -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Book</th>
                                            <th>Borrow Date</th>
                                            <th>Due Date</th>
                                            <th>Return Date</th>
                                            <th>Status</th>
                                            <th>Fine</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($borrows as $key => $borrow)
                                            <tr>
                                                <td>{{ $borrows->firstItem() + $key }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2">
                                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                                {{ strtoupper(substr($borrow->user->name, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">{{ $borrow->user->name }}</h6>
                                                            <small class="text-muted">{{ $borrow->user->email }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0">{{ $borrow->book->title }}</h6>
                                                    <small class="text-muted">by
                                                        {{ ($borrow->book->author->FirstName ?? '') . ' ' . ($borrow->book->author->LastName ?? '') ?: 'Unknown' }}</small>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($borrow->due_date)->format('d M Y') }}</td>
                                                <td>
                                                    @if ($borrow->return_date)
                                                        {{ \Carbon\Carbon::parse($borrow->return_date)->format('d M Y') }}
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($borrow->status == 'borrowed')
                                                        <span class="badge bg-primary">Borrowed</span>
                                                    @elseif($borrow->status == 'returned')
                                                        <span class="badge bg-success">Returned</span>
                                                    @else
                                                        <span class="badge bg-danger">Overdue</span>
                                                    @endif

                                                    @if ($borrow->fine_amount > 0)
                                                        <div class="mt-1">
                                                            <span class="text-danger fw-bold">${{ number_format($borrow->fine_amount, 2) }}</span>
                                                            <br>
                                                            <small class="badge bg-{{ $borrow->fine_status == 'paid' ? 'success' : 'warning' }} text-dark border">
                                                                {{ ucfirst($borrow->fine_status) }}
                                                            </small>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <!-- resources/views/Admin/borrow.blade.php -->

<td>
    @if ($borrow->status == 'borrowed')
        <!-- Return Button -->
        <form method="POST" action="{{ route('borrow.return', $borrow->id) }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Return this book?')">
                <i class="fas fa-check"></i> Return
            </button>
        </form>

        <!-- Renew Button -->
        <form method="POST" action="{{ route('borrow.renew', $borrow->id) }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-sm btn-info text-white" onclick="return confirm('Renew for 14 more days?')">
                <i class="fas fa-sync-alt"></i> Renew
            </button>
        </form>
        
    @elseif($borrow->status == 'overdue')
        <!-- Only Return allowed for Overdue -->
        <form method="POST" action="{{ route('borrow.return', $borrow->id) }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger text-white">
                <i class="fas fa-undo"></i> Return Overdue
            </button>
        </form>
    @else
        <span class="text-success"><i class="fas fa-check-circle"></i> Completed</span>
    @endif
</td>

                                                   
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-4">
                                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                                    <p class="text-muted mb-0">No borrow records found</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="mt-4">
                                {{ $borrows->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Borrow Book Modal -->
            <div class="modal fade" id="borrowModal" tabindex="-1" aria-labelledby="borrowModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="borrowModalLabel">Borrow Book</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('borrow.store') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">Select User <span
                                            class="text-danger">*</span></label>
                                    <select name="user_id" id="user_id" class="form-select" required>
                                        <option value="">Choose User...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="book_id" class="form-label">Select Book <span
                                            class="text-danger">*</span></label>
                                    <select name="book_id" id="book_id" class="form-select" required>
                                        <option value="">Choose Book...</option>
                                        @foreach ($books as $book)
                                            <option value="{{ $book->book_id }}">
                                                {{ $book->title }} - Available: {{ $book->available_quantity }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="due_date" class="form-label">Due Date (Optional)</label>
                                    <input type="date" name="due_date" id="due_date" class="form-control"
                                        min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}"
                                        value="{{ \Carbon\Carbon::now()->addDays((int)($settings['max_borrow_days'] ?? 14))->format('Y-m-d') }}">
                                    <small class="text-muted">Default: {{ $settings['max_borrow_days'] ?? 14 }} days from today</small>
                                </div>

                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Note:</strong> Each user can borrow a maximum of {{ $settings['max_books_per_member'] ?? 5 }} books at a time.
                                    Fines are charged at ${{ $settings['fine_per_day'] ?? '1.00' }}/day after the due date.
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-book-reader me-1"></i>Borrow Book
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection