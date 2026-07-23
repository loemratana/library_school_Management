@extends('Admin.admin_master')
@section('Admin')
<div class="container-fluid pt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-style mb-30 shadow-sm text-center">
                <h4 class="mb-20">Book QR Code</h4>
                <div class="p-4" style="background: white; display: inline-block; border-radius: 10px; margin-bottom: 20px;">
                    {!! QrCode::size(250)->generate(route('book.details', $book->book_id)) !!}
                </div>
                <h5>{{ $book->title }}</h5>
                <p class="text-muted">ISBN: {{ $book->isbn }}</p>
                <div class="mt-4">
                    <button class="btn btn-primary" onclick="window.print()"><i class="lni lni-printer"></i> Print</button>
                    <a href="{{ route('admin.book') }}" class="btn btn-secondary">Back to Books</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
