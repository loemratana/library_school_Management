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
            cursor: pointer;
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .book-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #4f46e5;
        }

        .book-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4f46e5, #7c3aed, #ec4899);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .book-card:hover::before {
            opacity: 1;
        }

        .book-image {
            width: 100%;
            height: 320px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .book-card:hover .book-image {
            transform: scale(1.05);
        }

        .book-image-placeholder {
            width: 100%;
            height: 320px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 64px;
            position: relative;
            overflow: hidden;
        }

        .book-image-placeholder::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) rotate(45deg);
            }
        }

        .book-card-body {
            padding: 20px;
            background: white;
        }

        .book-title {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            height: 44px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-height: 1.4;
        }

        .book-author {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .book-author i {
            font-size: 12px;
        }

        .section-title {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 24px;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title i {
            font-size: 32px;
        }

        .badge-category {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(79, 70, 229, 0.3);
        }

        .rating-stars {
            color: #fbbf24;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 4px;
            font-weight: 600;
        }

        .book-price {
            font-size: 18px;
            font-weight: 800;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .search-filter-box {
            background: white;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            margin-bottom: 32px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .view-toggle {
            display: flex;
            gap: 10px;
        }

        .view-toggle a {
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 600;
        }

        .view-toggle a.active {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.4);
        }

        .view-toggle a:not(.active) {
            background: #f1f5f9;
            color: #64748b;
        }

        .view-toggle a:not(.active):hover {
            background: #e2e8f0;
            transform: translateY(-2px);
        }
    </style>
    <section class="section">
        <div class="container-fluid mt-5">
            <!-- View Toggle -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Book Collection</h4>
                    <div class="d-flex gap-2 align-items-center">
                        <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addBookModal">
                            <i class="lni lni-plus"></i> Add Book
                        </a>
                        <a href="{{ route('admin.book') }}" class="btn">
                            <i class="lni lni-list"></i> Table View
                        </a>
                        <a href="{{ route('admin.book.collection') }}" class="btn active">
                            <i class="lni lni-grid-alt"></i> Card View
                        </a>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="search-filter-box">
                <form action="{{ route('admin.book.collection') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search by title, ISBN, or author..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="category" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="author" class="form-select">
                                <option value="">All Authors</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->AuthorID }}" {{ request('author') == $author->AuthorID ? 'selected' : '' }}>
                                        {{ $author->FirstName }} {{ $author->LastName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="lni lni-search-alt"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Collection Filter Buttons -->
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('admin.book.collection', ['filter' => 'all']) }}"
                        class="btn btn-sm {{ request('filter') == 'all' ? 'btn-primary' : 'btn-outline-primary' }}">
                        <i class="lni lni-library"></i> All Books
                    </a>
                    <a href="{{ route('admin.book.collection', ['filter' => 'popular']) }}"
                        class="btn btn-sm {{ request('filter') == 'popular' ? 'btn-warning' : 'btn-outline-warning' }}">
                        <i class="lni lni-star-filled"></i> Popular Books
                    </a>
                    <a href="{{ route('admin.book.collection', ['filter' => 'latest']) }}"
                        class="btn btn-sm {{ request('filter') == 'latest' ? 'btn-success' : 'btn-outline-success' }}">
                        <i class="lni lni-timer"></i> Latest Books
                    </a>
                </div>
            </div>

            <!-- Popular and Latest Books Sections (Default View Only) -->
            @if(!request()->has('filter') && !request()->has('search') && !request()->has('category'))
                <section class="mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="section-title mb-0">
                            <i class="lni lni-star-filled text-warning"></i> Popular Books
                        </h5>
                    </div>
                    <div class="row g-4">
                        @foreach($popularBooks as $book)
                            <div class="col-lg-4 col-md-5 col-sm-6">
                                <div class="book-card">
                                    @if($book->image)
                                        <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" class="book-image">
                                    @else
                                        <div class="book-image-placeholder">
                                            <i class="lni lni-book"></i>
                                        </div>
                                    @endif
                                    <div class="book-card-body">
                                        <h6 class="book-title">{{ $book->title }}</h6>
                                        <p class="book-author">
                                            <i class="lni lni-user"></i>
                                            {{ $book->author->FirstName ?? '' }} {{ $book->author->LastName ?? '' }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge-category">{{ $book->category->name ?? 'N/A' }}</span>
                                            <div class="rating-stars">
                                                <i class="lni lni-star-filled"></i>
                                                <span>{{ $book->borrows_count }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- Latest Books Section -->
                <section class="mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="section-title mb-0">
                            <i class="lni lni-timer text-primary"></i> Latest Books
                        </h5>
                    </div>
                    <div class="row g-4">
                        @foreach($latestBooks as $book)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="book-card">
                                    @if($book->image)
                                        <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" class="book-image">
                                    @else
                                        <div class="book-image-placeholder">
                                            <i class="lni lni-book"></i>
                                        </div>
                                    @endif
                                    <div class="p-3">
                                        <h6 class="mb-2" style="height: 40px; overflow: hidden; font-size: 14px;">
                                            {{ Str::limit($book->title, 50) }}
                                        </h6>
                                        <p class="text-muted mb-2 small">
                                            {{ $book->author->FirstName ?? '' }} {{ $book->author->LastName ?? '' }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge-category">{{ $book->category->name ?? 'N/A' }}</span>
                                            @if($book->price)
                                                <span class="text-primary fw-bold small">${{ number_format($book->price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- All Books Section (Shown when filter is active) -->
            @if(request()->has('filter') || request()->has('search') || request()->has('category'))
                <section class="mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="section-title mb-0">
                            @if(request()->has('search') || request()->has('category'))
                                <i class="lni lni-search-alt"></i> Search Results
                            @elseif(request('filter') == 'popular')
                                <i class="lni lni-star-filled text-warning"></i> Popular Books
                            @elseif(request('filter') == 'latest')
                                <i class="lni lni-timer text-success"></i> Latest Books
                            @else
                                <i class="lni lni-library"></i> All Books
                            @endif
                        </h5>
                    </div>
                    <div class="row g-4">
                        @forelse($books as $book)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="book-card">
                                    @if($book->image)
                                        <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" class="book-image">
                                    @else
                                        <div class="book-image-placeholder">
                                            <i class="lni lni-book"></i>
                                        </div>
                                    @endif
                                    <div class="p-3">
                                        <h6 class="mb-2" style="height: 40px; overflow: hidden; font-size: 14px;">
                                            {{ Str::limit($book->title, 50) }}
                                        </h6>
                                        <p class="text-muted mb-2 small">
                                            {{ $book->author->FirstName ?? '' }} {{ $book->author->LastName ?? '' }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge-category">{{ $book->category->name ?? 'N/A' }}</span>
                                            @if($book->price)
                                                <span class="text-primary fw-bold small">${{ number_format($book->price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info text-center">
                                    <i class="lni lni-information"></i> No books found matching your criteria.
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $books->links() }}
                    </div>
                </section>
            @endif

            <!-- Add Book Modal -->
            <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addBookModalLabel">Add Book</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                                        @error('title')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="isbn" class="form-label">ISBN</label>
                                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" value="{{ old('isbn') }}">
                                        @error('isbn')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="author_id" class="form-label">Author</label>
                                        <select class="form-select @error('author_id') is-invalid @enderror" id="author_id" name="author_id" required>
                                            <option value="" selected disabled>Select Author</option>
                                            @foreach($authors as $author)
                                                <option value="{{ $author->AuthorID }}" {{ old('author_id') == $author->AuthorID ? 'selected' : '' }}>
                                                    {{ $author->FirstName }} {{ $author->LastName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('author_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="publisher_id" class="form-label">Publisher</label>
                                        <select class="form-select @error('publisher_id') is-invalid @enderror" id="publisher_id" name="publisher_id" required>
                                            <option value="" selected disabled>Select Publisher</option>
                                            @php
                                                $publishers = App\Models\Publisher::orderBy('name', 'ASC')->get();
                                            @endphp
                                            @foreach($publishers as $publisher)
                                                <option value="{{ $publisher->publisher_id }}" {{ old('publisher_id') == $publisher->publisher_id ? 'selected' : '' }}>{{ $publisher->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('publisher_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="publish_year" class="form-label">Publish Year</label>
                                        <input type="text" class="form-control" id="publish_year" name="publish_year" value="{{ old('publish_year') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
                                        @error('quantity')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Book Cover</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection