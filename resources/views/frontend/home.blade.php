@extends('frontend.master')
@section('title', 'Libra - Premium Book Management')

@section('content')
<section class="hero">
    <h1>Discover a Universe of Knowledge</h1>
    <p>Access thousands of books, place reservations, and manage your reads seamlessly in our premium library.</p>
    <a href="{{ route('catalog') }}" class="btn btn-primary" style="padding: 1rem 2.5rem; font-size: 1.1rem; border-radius: 2rem;">Explore Catalog <i class="fa-solid fa-arrow-right" style="margin-left: 0.5rem;"></i></a>
</section>

<div class="section-title">
    <i class="fa-solid fa-star" style="color: var(--primary);"></i> Featured & Latest Additions
</div>

<div class="book-grid">
    @forelse($featuredBooks as $book)
        <a href="{{ route('book.details', $book->book_id) }}" style="text-decoration: none;">
            <div class="book-card">
                @if($book->available_quantity > 0)
                    <div class="book-badge" style="background: var(--secondary);">Available</div>
                @else
                    <div class="book-badge" style="background: var(--warning);">On Hold</div>
                @endif
                
                <div class="book-img-wrapper">
                    <!-- Placeholder image if actual image is missing, you can adjust to use $book->image if available -->
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($book->title) }}&background=334155&color=fff&size=400&font-size=0.1" alt="{{ $book->title }}" class="book-img">
                </div>
                <div class="book-info">
                    <div class="book-category">{{ $book->category->name ?? 'Uncategorized' }}</div>
                    <div class="book-title">{{ Str::limit($book->title, 40) }}</div>
                    <div class="book-author">By {{ $book->author->FirstName ?? '' }} {{ $book->author->LastName ?? 'Unknown' }}</div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
                        <i class="fa-solid fa-star" style="color: #fbbf24;"></i> {{ number_format($book->average_rating, 1) }}
                    </div>
                </div>
            </div>
        </a>
    @empty
        <p style="padding: 0 5%; color: var(--text-muted);">No books available at the moment.</p>
    @endforelse
</div>
@endsection
