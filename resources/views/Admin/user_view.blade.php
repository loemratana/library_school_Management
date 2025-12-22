@extends('Admin.admin_master')
@section('Admin')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <div class="title d-flex flex-wrap align-items-center justify-content-between">
                    <div class="left">
                        <h6 class="text-medium mb-30">User Details</h6>
                    </div>
                    <div class="right">
                        <a href="{{ route('admin.user.management') }}" class="main-btn primary-btn btn-hover btn-sm">
                            <i class="lni lni-arrow-left mr-5"></i> Back to List
                        </a>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-4">
                            <img src="{{ (!empty($user->profile_image)) ? url('upload/admin_images/' . $user->profile_image) : url('upload/no_image.jpg') }}"
                                alt="{{ $user->name }}" class="rounded-circle"
                                style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #e5e5e5;">
                            <h4 class="mt-3">{{ $user->name }}</h4>
                            <p class="text-muted">
                                @if($user->role == 'admin')
                                    <span class="badge bg-success">Admin</span>
                                @elseif($user->role == 'librarian')
                                    <span class="badge bg-warning text-dark">Librarian</span>
                                @else
                                    <span class="badge bg-info text-dark">Member</span>
                                @endif
                            </p>
                        </div>

                        <div class="input-style-1">
                            <label>Name</label>
                            <input type="text" value="{{ $user->name }}" readonly disabled />
                        </div>
                        <div class="input-style-1">
                            <label>Email</label>
                            <input type="email" value="{{ $user->email }}" readonly disabled />
                        </div>
                        <div class="input-style-1">
                            <label>Phone</label>
                            <input type="text" value="{{ $user->phone ?? 'N/A' }}" readonly disabled />
                        </div>
                        <div class="input-style-1">
                            <label>Address</label>
                            <textarea readonly disabled>{{ $user->address ?? 'N/A' }}</textarea>
                        </div>
                        <div class="input-style-1">
                            <label>Joined At</label>
                            <input type="text" value="{{ $user->created_at->format('d M Y, h:i A') }}" readonly disabled />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection