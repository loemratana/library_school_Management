@extends('Admin.admin_master')
@section('Admin')
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-12">
            <div class="card-style mb-30 shadow-sm">
                <div class="title d-flex flex-wrap justify-content-between mb-20">
                    <div class="left">
                        <h6 class="text-medium text-muted">Book Reservations</h6>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table top-selling-table">
                        <thead>
                            <tr>
                                <th>Book Title</th>
                                <th>Member Name</th>
                                <th>Status</th>
                                <th>Reservation Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservations as $res)
                                <tr>
                                    <td>
                                        <p class="text-sm font-weight-bold">{{ $res->book->title ?? 'N/A' }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm text-muted">{{ $res->user->name ?? 'N/A' }}</p>
                                    </td>
                                    <td>
                                        @if($res->status == 'pending')
                                            <span class="status-btn warning-btn py-1 px-3">Pending</span>
                                        @elseif($res->status == 'fulfilled')
                                            <span class="status-btn success-btn py-1 px-3">Fulfilled</span>
                                        @else
                                            <span class="status-btn close-btn py-1 px-3">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <p class="text-sm">{{ $res->created_at->format('M d, Y') }}</p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">No reservations found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    {{ $reservations->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
