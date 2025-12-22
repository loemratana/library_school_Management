@extends('Admin.admin_master')
@section('Admin')
    <section class="table-components">
        <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Category Management</h2>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Category
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->

            <!-- ========== tables-wrapper start ========== -->
            <div class="tables-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <div class="d-flex justify-content-between align-items-center mb-10">
                                <h6 class="mb-10">Category List</h6>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addCategoryModal">
                                    <i class="lni lni-plus"></i> Add Category
                                </button>
                            </div>
                            <div class="table-wrapper table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>#</h6>
                                            </th>
                                            <th>
                                                <h6>Name</h6>
                                            </th>
                                            <th>
                                                <h6>Description</h6>
                                            </th>
                                            <th>
                                                <h6>Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $key => $item)
                                            <tr>
                                                <td class="min-width">
                                                    <p>{{ $key + 1 }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $item->name }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $item->description }}</p>
                                                </td>
                                                <td>
                                                    <div class="action">
                                                        <button class="text-primary" data-bs-toggle="modal"
                                                            data-bs-target="#editCategoryModal" data-id="{{ $item->id }}"
                                                            data-name="{{ $item->name }}"
                                                            data-description="{{ $item->description }}"
                                                            onclick="editCategory(this)">
                                                            <i class="lni lni-pencil-alt"></i>
                                                        </button>
                                                        <a onclick="return confirm('Are you sure you want to delete this user?')"
                                                            href="{{ route('category.delete', $item->id) }}"
                                                            class="text-danger delete-btn">
                                                            <i class="lni lni-trash-can"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- ========== tables-wrapper end ========== -->
        </div>
        <!-- end container -->
    </section>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <h5 class="text-bold">Add Category</h5>
                    <button type="button" class="btn border-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="lni lni-close"></i>
                    </button>
                </div>
                <div class="modal-body px-0">
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="input-style-1">
                            <label>Category Name</label>
                            <input type="text" name="name" placeholder="Category Name" required />
                        </div>
                        <div class="input-style-1">
                            <label>Description</label>
                            <textarea name="description" placeholder="Description" rows="3" required></textarea>
                        </div>
                        <div class="action d-flex justify-content-end">
                            <button type="submit" class="main-btn primary-btn btn-hover">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <h5 class="text-bold">Edit Category</h5>
                    <button type="button" class="btn border-0" data-bs-dismiss="modal" aria-label="Close">
                        <i class="lni lni-close"></i>
                    </button>
                </div>
                <div class="modal-body px-0">
                    <form action="{{ route('category.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <div class="input-style-1">
                            <label>Category Name</label>
                            <input type="text" name="name" id="edit_name" required />
                        </div>
                        <div class="input-style-1">
                            <label>Description</label>
                            <textarea name="description" id="edit_description" rows="3" required></textarea>
                        </div>
                        <div class="action d-flex justify-content-end">
                            <button type="submit" class="main-btn primary-btn btn-hover">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Form -->
    <form id="delete-form" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function editCategory(element) {
            var id = element.getAttribute('data-id');
            var name = element.getAttribute('data-name');
            var description = element.getAttribute('data-description');

            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_description').value = description;
        }

        // SweetAlert Delete
        $(function () {
            $(document).on('click', '.delete-btn', function (e) {
                e.preventDefault();
                var link = $(this).attr("href");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = document.getElementById('delete-form');
                        form.action = link;
                        form.submit();
                    }
                })
            });
        });
    </script>
@endsection