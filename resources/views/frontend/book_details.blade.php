@extends('frontend.master')
@section('title', $book->title . ' - Libra')

@section('content')
<div class="detail-container">
    <div>
        <img src="https://ui-avatars.com/api/?name={{ urlencode($book->title) }}&background=334155&color=fff&size=600&font-size=0.1" alt="{{ $book->title }}" class="detail-img">
    </div>
    
    <div class="detail-content">
        <div class="book-category" style="font-size: 1rem;">{{ $book->category->name ?? 'Uncategorized' }}</div>
        <h1>{{ $book->title }}</h1>
        <div class="detail-meta">
            <span><i class="fa-solid fa-user-pen"></i> By {{ $book->author->FirstName ?? '' }} {{ $book->author->LastName ?? 'Unknown' }}</span>
            <span><i class="fa-solid fa-building"></i> {{ $book->publisher->PublisherName ?? 'Unknown Publisher' }}</span>
            <span><i class="fa-solid fa-hashtag"></i> ISBN: {{ $book->isbn }}</span>
        </div>
        
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
            <div style="font-size: 2rem; font-weight: 700; color: #fbbf24;">
                {{ number_format($book->average_rating, 1) }}
            </div>
            <div style="color: var(--text-muted);">
                <i class="fa-solid fa-star" style="color: #fbbf24;"></i>
                based on {{ $book->reviews->where('approved', true)->count() }} reviews
            </div>
        </div>

        <p class="detail-desc">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </p>

        <div style="padding: 2rem; background: rgba(255, 255, 255, 0.05); border-radius: 1rem; border: 1px solid var(--border); margin-bottom: 3rem;">
            <h3 style="margin-bottom: 1rem;">Availability Status</h3>
            @if($book->available_quantity > 0)
                <div style="display: flex; align-items: center; gap: 1rem; color: #34d399; font-size: 1.25rem; font-weight: 600;">
                    <i class="fa-solid fa-circle-check"></i> Available ({{ $book->available_quantity }} copies)
                </div>
                <p style="margin-top: 1rem; color: var(--text-muted);">Visit the library to borrow this book today.</p>
            @else
                <div style="display: flex; align-items: center; gap: 1rem; color: #f59e0b; font-size: 1.25rem; font-weight: 600;">
                    <i class="fa-solid fa-clock"></i> Currently Checked Out
                </div>
                @auth
                    <form action="{{ route('reserve.store', $book->book_id) }}" method="POST" style="margin-top: 1.5rem;">
                        @csrf
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Place Reservation (Hold)</button>
                    </form>
                @else
                    <p style="margin-top: 1rem; color: var(--text-muted);"><a href="{{ route('login') }}" style="color: var(--primary);">Log in</a> to reserve this book.</p>
                @endauth
            @endif
        </div>
    </div>
</div>

<div style="padding: 0 5% 4rem; max-width: 1400px; margin: 0 auto;">
    <h2 class="section-title" style="padding: 0;">Reviews & Ratings</h2>
    
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 4rem;">
        <div>
            @auth
                <div style="background: var(--bg-card); padding: 2rem; border-radius: 1rem; border: 1px solid var(--border);">
                    <h3 style="margin-bottom: 1.5rem;">Write a Review</h3>
                    <form action="{{ route('review.store', $book->book_id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 0.5rem;">Rating</label>
                            <select name="rating" class="form-control" required>
                                <option value="5">5 Stars - Excellent</option>
                                <option value="4">4 Stars - Very Good</option>
                                <option value="3">3 Stars - Good</option>
                                <option value="2">2 Stars - Fair</option>
                                <option value="1">1 Star - Poor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 0.5rem;">Review (Optional)</label>
                            <textarea name="review" class="form-control" rows="4" placeholder="Share your thoughts about this book..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Submit Review</button>
                    </form>
                </div>
            @else
                <div style="padding: 2rem; border: 1px dashed var(--border); border-radius: 1rem; text-align: center;">
                    <p style="color: var(--text-muted); margin-bottom: 1rem;">Log in to write a review for this book.</p>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Sign In</a>
                </div>
            @endauth
        </div>
        
        <div>
            @forelse($book->reviews->where('approved', true) as $review)
                <div class="review-card">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                        <strong>{{ $review->user->name }}</strong>
                        <div class="stars">
                            @for($i=1; $i<=5; $i++)
                                <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star"></i>
                            @endfor
                        </div>
                    </div>
                    @if($review->review)
                        <p style="color: var(--text-muted);">{{ $review->review }}</p>
                    @endif
                    <div style="font-size: 0.8rem; color: #64748b; margin-top: 1rem;">
                        Posted on {{ $review->created_at->format('M d, Y') }}
                    </div>
                </div>
            @empty
                <p style="color: var(--text-muted);">No reviews yet. Be the first to review!</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
