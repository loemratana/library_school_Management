@extends('Admin.admin_master')
@section('Admin')
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-12">
            <div class="card-style mb-30 shadow-sm border-0 rounded-4">
                <div class="title d-flex flex-wrap justify-content-between mb-2">
                    <div class="left">
                        <h6 class="text-medium text-muted"><i class="lni lni-star-half"></i> Book Reviews Moderation</h6>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table top-selling-table table-hover align-middle">
                        <thead>
                            <tr>
                                <th><h6 class="text-sm text-medium text-muted">Book</h6></th>
                                <th><h6 class="text-sm text-medium text-muted">Member</h6></th>
                                <th><h6 class="text-sm text-medium text-muted">Rating & Review</h6></th>
                                <th><h6 class="text-sm text-medium text-muted">Status</h6></th>
                                <th class="text-end"><h6 class="text-sm text-medium text-muted">Action</h6></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews as $review)
                                <tr>
                                    <td>
                                        <p class="text-sm font-weight-bold text-dark">{{ Str::limit($review->book->title ?? 'N/A', 25) }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm text-muted">{{ $review->user->name ?? 'N/A' }}</p>
                                    </td>
                                    <td>
                                        <div class="text-warning mb-1" style="font-size: 0.9rem;">
                                            @for($i=1; $i<=5; $i++)
                                                <i class="lni lni-star{{ $i <= $review->rating ? '-filled' : '' }}"></i>
                                            @endfor
                                        </div>
                                        <p class="text-sm text-muted" style="max-width: 300px; white-space: normal;">{{ Str::limit($review->review, 50) }}</p>
                                    </td>
                                    <td>
                                        @if($review->approved)
                                            <span class="badge bg-success rounded-pill py-1 px-3">Public</span>
                                        @else
                                            <span class="badge bg-secondary rounded-pill py-1 px-3">Hidden</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <form action="{{ route('admin.review.toggle', $review->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-{{ $review->approved ? 'warning' : 'success' }} rounded-pill px-3 me-2">
                                                {{ $review->approved ? 'Hide' : 'Approve' }}
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.review.delete', $review->id) }}" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Delete this review permanently?')">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No reviews found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    {{ $reviews->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
