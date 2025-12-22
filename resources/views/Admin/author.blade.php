@extends('Admin.admin_master')
@section('Admin')
    <section class="page-content">
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <div class="title d-flex flex-wrap align-items-center justify-content-between">
                            <div class="left">
                                <h6 class="text-medium mb-30">Author Management</h6>
                            </div>
                            <div class="right">
                                <a href="#" class="main-btn primary-btn btn-hover btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addAuthorModal">
                                    <i class="lni lni-plus mr-5"></i> Add Author
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
                                            <h6>First Name</h6>
                                        </th>
                                        <th>
                                            <h6>Last Name</h6>
                                        </th>
                                        <th>
                                            <h6>Action</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($authors as $key => $author)
                                        <tr>
                                            <td class="min-width">
                                                <p>{{ $key + 1 }}</p>
                                            </td>
                                            <td class="min-width">
                                                <p>{{ $author->FirstName }}</p>
                                            </td>
                                            <td class="min-width">
                                                <p>{{ $author->LastName }}</p>
                                            </td>
                                            <td>
                                                <div class="action d-flex justify-content-center gap-2">
                                                    <a href="#" class="text-primary edit-btn" data-bs-toggle="modal"
                                                        data-bs-target="#editAuthorModal" data-id="{{ $author->id }}"
                                                        data-firstname="{{ $author->FirstName }}"
                                                        data-lastname="{{ $author->LastName }}">
                                                        <i class="lni lni-pencil-alt"></i>
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

            <!-- Add Author Modal -->
            <div class="modal fade" id="addAuthorModal" tabindex="-1" aria-labelledby="addAuthorModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('author.store') }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAuthorModalLabel">Add Author</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="FirstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="FirstName" name="FirstName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="LastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="LastName" name="LastName" required>
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

            <!-- Edit Author Modal -->
            <div class="modal fade" id="editAuthorModal" tabindex="-1" aria-labelledby="editAuthorModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('author.update') }}">
                            @csrf
                            <input type="hidden" name="id" id="edit_id">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editAuthorModalLabel">Edit Author</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="edit_FirstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="edit_FirstName" name="FirstName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_LastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="edit_LastName" name="LastName" required>
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
            var editFirstNameInput = document.getElementById("edit_FirstName");
            var editLastNameInput = document.getElementById("edit_LastName");

            editButtons.forEach(function (button) {
                button.addEventListener("click", function () {
                    var id = this.getAttribute("data-id");
                    var firstname = this.getAttribute("data-firstname");
                    var lastname = this.getAttribute("data-lastname");

                    // Populate fields
                    editIdInput.value = id;
                    editFirstNameInput.value = firstname;
                    editLastNameInput.value = lastname;
                });
            });
        });
    </script>
@endsection