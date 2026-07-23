@extends('frontend.master')
@section('title', 'Catalog - Libra')

@section('content')
<div style="padding: 3rem 5%;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; flex-wrap: wrap; gap: 1rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800;">Book Catalog</h1>
        
        <form action="{{ route('catalog') }}" method="GET" style="display: flex; gap: 1rem; flex: 1; max-width: 600px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title..." class="form-control" style="flex: 2;">
            <select name="category" class="form-control" style="flex: 1;">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-search"></i></button>
        </form>
    </div>

    <div class="book-grid" style="padding: 0;">
        @forelse($books as $book)
            <a href="{{ route('book.details', $book->book_id) }}" style="text-decoration: none;">
                <div class="book-card">
                    @if($book->available_quantity > 0)
                        <div class="book-badge" style="background: var(--secondary);">Available</div>
                    @else
                        <div class="book-badge" style="background: var(--warning);">On Hold</div>
                    @endif
                    
                    <div class="book-img-wrapper">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($book->title) }}&background=334155&color=fff&size=400&font-size=0.1" alt="{{ $book->title }}" class="book-img">
                    </div>
                    <div class="book-info">
                        <div class="book-category">{{ $book->category->name ?? 'Uncategorized' }}</div>
                        <div class="book-title">{{ Str::limit($book->title, 40) }}</div>
                        <div class="book-author">By {{ $book->author->FirstName ?? '' }} {{ $book->author->LastName ?? 'Unknown' }}</div>
                    </div>
                </div>
            </a>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 0;">
                <i class="fa-solid fa-book-open" style="font-size: 4rem; color: var(--border); margin-bottom: 1rem;"></i>
                <h3 style="color: var(--text-muted);">No books found matching your criteria.</h3>
            </div>
        @endforelse
    </div>

    <div style="margin-top: 3rem; display: flex; justify-content: center;">
        {{ $books->links('pagination::bootstrap-4') }} <!-- Assumes standard laravel paginator, might need restyling -->
    </div>
</div>
@endsection
