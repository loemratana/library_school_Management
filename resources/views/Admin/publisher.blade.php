@extends('Admin.admin_master')
@section('Admin')

    <section class="page-content">
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <div class="title d-flex flex-wrap align-items-center justify-content-between">
                            <div class="left">
                                <h6 class="text-medium mb-30">Publisher Management</h6>
                            </div>
                            <div class="right">
                                <a href="#" class="main-btn primary-btn btn-hover btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addPublisherModal">
                                    <i class="lni lni-plus mr-5"></i> Add Publisher
                                </a>
                            </div>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h6>ID</h6>
                                        </th>
                                        <th>
                                            <h6>Name</h6>
                                        </th>
                                        <th>
                                            <h6>Email</h6>
                                        </th>
                                        <th>
                                            <h6>Phone</h6>
                                        </th>
                                        <th>
                                            <h6>Address</h6>
                                        </th>
                                        <th>
                                            <h6>Action</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($publishers as $key => $publisher)
                                        <tr>
                                            <td class="min-width">
                                                <p>{{ $key + 1 }}</p>
                                            </td>
                                            <td class="min-width">
                                                <p>{{ $publisher->name }}</p>
                                            </td>
                                            <td class="min-width">
                                                <p>{{ $publisher->email }}</p>
                                            </td>
                                            <td class="min-width">
                                                <p>{{ $publisher->phone }}</p>
                                            </td>
                                            <td class="min-width">
                                                <p>{{ $publisher->address }}</p>
                                            </td>
                                            <td>
                                                <div class="action d-flex justify-content-center gap-2">
                                                    <a href="#" class="text-primary edit-btn" data-bs-toggle="modal"
                                                        data-bs-target="#editPublisherModal"
                                                        data-id="{{ $publisher->publisher_id }}"
                                                        data-name="{{ $publisher->name }}" data-email="{{ $publisher->email }}"
                                                        data-phone="{{ $publisher->phone }}"
                                                        data-address="{{ $publisher->address }}">
                                                        <i class="lni lni-pencil-alt"></i>
                                                    </a>
                                                    <a onclick="return confirm('Are you sure you want to delete this publisher?')"
                                                        href="{{ route('publisher.delete', $publisher->publisher_id) }}"
                                                        class="text-danger" id="delete">
                                                        <i class="lni lni-trash-can"></i>
                                                    </a>
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

            <!-- Add Publisher Modal -->
            <div class="modal fade" id="addPublisherModal" tabindex="-1" aria-labelledby="addPublisherModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('publisher.store') }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addPublisherModalLabel">Add Publisher</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address"></textarea>
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

            <!-- Edit Publisher Modal -->
            <div class="modal fade" id="editPublisherModal" tabindex="-1" aria-labelledby="editPublisherModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('publisher.update') }}">
                            @csrf
                            <input type="hidden" name="id" id="edit_id">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPublisherModalLabel">Edit Publisher</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="edit_name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="edit_name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="edit_email" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="edit_phone" name="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_address" class="form-label">Address</label>
                                    <textarea class="form-control" id="edit_address" name="address"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update changes</button>
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
            var editIdInput = document.getElementById("edit_id");
            var editNameInput = document.getElementById("edit_name");
            var editEmailInput = document.getElementById("edit_email");
            var editPhoneInput = document.getElementById("edit_phone");
            var editAddressInput = document.getElementById("edit_address");

            editButtons.forEach(function (button) {
                button.addEventListener("click", function () {
                    var id = this.getAttribute("data-id");
                    var name = this.getAttribute("data-name");
                    var email = this.getAttribute("data-email");
                    var phone = this.getAttribute("data-phone");
                    var address = this.getAttribute("data-address");

                    // Populate fields
                    editIdInput.value = id;
                    editNameInput.value = name;
                    editEmailInput.value = email;
                    editPhoneInput.value = phone;
                    editAddressInput.value = address;
                });
            });
        });
    </script>
@endsection