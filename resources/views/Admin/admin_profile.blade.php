@extends('Admin.admin_master')
@section('Admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style settings-card-2 mb-30"
                    style="margin-top: 30px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border: none;">
                    <div class="title-box">
                        <h6 class="mb-10">Admin Profile</h6>
                    </div>
                    <div class="profile-info">
                        <div class="profile-image"
                            style="position: relative; height: 180px; background: linear-gradient(135deg, #4A6CF7 0%, #304cb2 100%);">
                            <div class="profile-img-wrap"
                                style="position: absolute; bottom: -50px; left: 30px; border: 5px solid #fff; border-radius: 50%; overflow: hidden; width: 120px; height: 120px; background: #fff;">
                                <img src="{{ (!empty($adminData->profile_image)) ? url('upload/admin_images/' . $adminData->profile_image) : url('upload/image.png') }}"
                                    alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>

                        <div class="profile-content" style="padding: 60px 30px 30px 30px;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h4 class="text-bold mb-10">{{ $adminData->name }}</h4>
                                    <p class="text-medium text-gray mb-30">{{ $adminData->email }}</p>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="input-style-1">
                                                <label style="font-weight: 600; color: #5D657B;">User Name</label>
                                                <p style="font-size: 15px; color: #1e1e1e; padding: 10px 0;">
                                                    {{ $adminData->name }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="input-style-1">
                                                <label style="font-weight: 600; color: #5D657B;">Role</label>
                                                <p style="font-size: 15px; color: #1e1e1e; padding: 10px 0;">
                                                    {{ $adminData->role }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="input-style-1">
                                                <label style="font-weight: 600; color: #5D657B;">Phone</label>
                                                <p style="font-size: 15px; color: #1e1e1e; padding: 10px 0;">
                                                    {{ $adminData->phone }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="input-style-1">
                                                <label style="font-weight: 600; color: #5D657B;">Address</label>
                                                <p style="font-size: 15px; color: #1e1e1e; padding: 10px 0;">
                                                    {{ $adminData->address }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="input-style-1">
                                                <label style="font-weight: 600; color: #5D657B;">Email</label>
                                                <p style="font-size: 15px; color: #1e1e1e; padding: 10px 0;">
                                                    {{ $adminData->email }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="input-style-1">
                                                <label style="font-weight: 600; color: #5D657B;">Account Created</label>
                                                <p style="font-size: 15px; color: #1e1e1e; padding: 10px 0;">
                                                    {{ $adminData->created_at->format('d M, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-end">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editProfileModal"
                                        class="main-btn primary-btn btn-hover">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $adminData->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $adminData->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $adminData->phone }}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $adminData->address }}">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            @if ($adminData->role === 'admin')
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                                    <option value="member" {{ $adminData->role === 'member' ? 'selected' : '' }}>Member</option>
                                    <option value="admin" {{ $adminData->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="librarian" {{ $adminData->role === 'librarian' ? 'selected' : '' }}>Librarian
                                    </option>
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            @else
                                <input type="text" class="form-control" value="{{ $adminData->role }}" readonly>
                                <input type="hidden" name="role" value="{{ $adminData->role }}">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="profile_image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image">
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
@endsection