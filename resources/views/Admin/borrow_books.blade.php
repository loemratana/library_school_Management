@extends('Admin.admin_master')
@section('Admin')
    <style>
        .book-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .book-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            border-color: #4f46e5;
        }

        .book-image {
            width: 100%;
            height: 280px;
            object-fit: cover;
        }

        .book-image-placeholder {
            width: 100%;
            height: 280px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }

        .book-card-body {
            padding: 15px;
        }

        .book-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 5px;
            height: 48px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .book-info {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 10px;
        }

        .availability-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            z-index: 10;
        }

        .bg-available { background: #dcfce7; color: #166534; }
        .bg-unavailable { background: #fee2e2; color: #991b1b; }

        .borrow-btn {
            width: 100%;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .search-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-1">Select Book to Borrow</h4>
                    <p class="text-muted small mb-0">Browse and issue books to users</p>
                </div>
                <a href="{{ route('admin.borrows') }}" class="btn btn-secondary">
                    <i class="fas fa-list me-1"></i> View All Borrows
                </a>
            </div>

            <!-- Search Area -->
            <div class="search-container">
                <form action="{{ route('admin.borrows.books') }}" method="GET">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Search by title, ISBN, or author..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Books Grid -->
            <div class="row g-4">
                @forelse($books as $book)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="book-card">
                            @php
                                $isAvailable = $book->available_quantity > 0;
                            @endphp
                            
                            <span class="availability-badge {{ $isAvailable ? 'bg-available' : 'bg-unavailable' }}">
                                {{ $isAvailable ? 'Available: '.$book->available_quantity : 'Out of Stock' }}
                            </span>

                            @if($book->image)
                                <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" class="book-image">
                            @else
                                <div class="book-image-placeholder">
                                    <i class="fas fa-book"></i>
                                </div>
                            @endif

                            <div class="book-card-body">
                                <h6 class="book-title">{{ $book->title }}</h6>
                                <div class="book-info">
                                    <div class="mb-1"><i class="fas fa-user-nib me-1"></i> {{ $book->author->FirstName ?? '' }} {{ $book->author->LastName ?? '' }}</div>
                                    <div><i class="fas fa-tags me-1"></i> {{ $book->category->name ?? 'N/A' }}</div>
                                </div>
                                <button type="button" 
                                        class="btn btn-primary borrow-btn {{ !$isAvailable ? 'disabled' : '' }}"
                                        onclick="openBorrowModal('{{ $book->book_id }}', '{{ addslashes($book->title) }}')"
                                        {{ !$isAvailable ? 'disabled' : '' }}>
                                    <i class="fas fa-book-reader me-2"></i> Borrow Now
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="text-muted">
                            <i class="fas fa-search fa-3x mb-3"></i>
                            <h5>No books found</h5>
                            <p>Try adjusting your search criteria</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $books->links() }}
            </div>
        </div>
    </div>

    <!-- Quick Borrow Modal -->
    <div class="modal fade" id="quickBorrowModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Issue Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('borrow.store') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="book_id" id="modal_book_id">
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Book Selected</label>
                            <div id="modal_book_title" class="p-2 bg-light rounded border"></div>
                        </div>

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Select User <span class="text-danger">*</span></label>
                            <select name="user_id" id="user_id" class="form-select select2" required>
                                <option value="">Choose User...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" name="due_date" id="due_date" class="form-control"
                                min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}"
                                value="{{ \Carbon\Carbon::now()->addDays((int)($settings['max_borrow_days'] ?? 14))->format('Y-m-d') }}">
                            <small class="text-muted">Default is {{ $settings['max_borrow_days'] ?? 14 }} days from today</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm Issue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openBorrowModal(bookId, bookTitle) {
            document.getElementById('modal_book_id').value = bookId;
            document.getElementById('modal_book_title').innerText = bookTitle;
            var myModal = new bootstrap.Modal(document.getElementById('quickBorrowModal'));
            myModal.show();
        }
    </script>
@endsection
