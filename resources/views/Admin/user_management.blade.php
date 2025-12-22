@extends('Admin.admin_master')
@section('Admin')
    <section class="page-content">
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <div class="title d-flex flex-wrap align-items-center justify-content-between">
                            <div class="left">
                                <h6 class="text-medium mb-30">User Management</h6>
                            </div>
                            <div class="right">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addUserModal">
                                    <i class="lni lni-plus"></i> Add User
                                </button>
                            </div>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>SL</h6>
                                        </th>
                                        <th>
                                            <h6>Image</h6>
                                        </th>
                                        <th>
                                            <h6>Name</h6>
                                        </th>
                                        <th>
                                            <h6>Email</h6>
                                        </th>
                                        <th>
                                            <h6>Role</h6>
                                        </th>
                                        <th>
                                            <h6>Action</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $key => $user)
                                        <tr>
                                            <td class="min-width">
                                                <p>{{ $key + 1 }}</p>
                                            </td>
                                            <td class="min-width">
                                                <div class="lead">
                                                    <div class="lead-image">
                                                        @if(!empty($user->profile_image))
                                                            <img src="{{ url('upload/admin_images/' . $user->profile_image) }}"
                                                                alt="{{ $user->name }}">
                                                        @else
                                                            @php
                                                                $name = $user->name;
                                                                $parts = explode(' ', trim($name));
                                                                $initials = (count($parts) >= 2) ? strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1)) : strtoupper(substr($name, 0, 2));
                                                            @endphp
                                                            <div class="initials-avatar">{{ $initials }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="min-width">
                                                <p>{{ $user->name }}</p>
                                            </td>
                                            <td class="min-width">
                                                <p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                                            </td>
                                            <td class="min-width">
                                                @if($user->role == 'admin')
                                                    <span class="status-btn success-btn">Admin</span>
                                                @elseif($user->role == 'librarian')
                                                    <span class="status-btn warning-btn">Librarian</span>
                                                @else
                                                    <span class="status-btn info-btn">Member</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action d-flex justify-content-center gap-2">
                                                    @if(Auth::user()->role === 'admin')
                                                        <a href="{{ route('admin.user.view', $user->id) }}" class="text-info">
                                                            <i class="lni lni-eye"></i>
                                                        </a>
                                                        <a href="#" class="text-primary edit-btn" data-bs-toggle="modal"
                                                            data-bs-target="#editUserModal" data-id="{{ $user->id }}"
                                                            data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                                            data-role="{{ $user->role }}">
                                                            <i class="lni lni-pencil-alt"></i>
                                                        </a>
                                                        <a href="{{ route('admin.user.delete', $user->id) }}" class="text-danger"
                                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                                            <i class="lni lni-trash-can"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('admin.user.view', $user->id) }}" class="text-info">
                                                            <i class="lni lni-eye"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add User Modal -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content card-style">
                        <div class="modal-header px-0 border-0">
                            <h5 class="text-bold">Add User</h5>
                            <button type="button" class="btn border-0" data-bs-dismiss="modal" aria-label="Close">
                                <i class="lni lni-close"></i>
                            </button>
                        </div>
                        <div class="modal-body px-0">
                            <form method="POST" action="{{ route('admin.user.store')}}">
                                @csrf
                                <div class="input-style-1">
                                    <label>User Name</label>
                                    <input type="text" name="name" placeholder="User Name" required />
                                </div>
                                <div class="input-style-1">
                                    <label>Email</label>
                                    <input type="email" name="email" placeholder="Email" required />
                                </div>
                                <div class="input-style-1">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Password" required />
                                </div>
                                <div class="select-style-1">
                                    <label>Role</label>
                                    <div class="select-position">
                                        <select name="role" required>
                                            <option value="" disabled selected>Select Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="librarian">Librarian</option>
                                            <option value="member">Member</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="action d-flex justify-content-end">
                                    <button type="submit" class="main-btn primary-btn btn-hover">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit User Modal -->
            <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="editUserForm" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" id="role" name="role">
                                        <option value="admin">Admin</option>
                                        <option value="member">Member</option>
                                        <option value="librarian">Librarian</option>
                                    </select>
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


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var editButtons = document.querySelectorAll(".edit-btn");
            var editForm = document.getElementById("editUserForm");
            var nameInput = document.getElementById("name");
            var emailInput = document.getElementById("email");
            var roleInput = document.getElementById("role");

            editButtons.forEach(function (button) {
                button.addEventListener("click", function () {
                    var id = this.getAttribute("data-id");
                    var name = this.getAttribute("data-name");
                    var email = this.getAttribute("data-email");
                    var role = this.getAttribute("data-role");

                    // Set form action dynamically
                    editForm.action = "/users/" + id; // Assuming a route like /users/{id} for update

                    // Populate fields
                    nameInput.value = name;
                    emailInput.value = email;
                    roleInput.value = role;
                });
            });
        });
    </script>
@endsection