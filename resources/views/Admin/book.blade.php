@extends('Admin.admin_master')
@section('Admin')
    <!-- View Toggle -->
    <section class="section">
        <div class="container-fluid mt-5">
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Book Management</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.book') }}" class="btn btn-primary btn-sm">
                            <i class="lni lni-list"></i> Table View
                        </a>
                        <a href="{{ route('admin.book.collection') }}" class="btn btn-outline-primary btn-sm">
                            <i class="lni lni-grid-alt"></i> Card View
                        </a>
                    </div>
                </div>
            </div>
            <!-- Search and Filter Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <form action="{{ route('admin.book') }}" method="GET" class="mb-4">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Search by title, ISBN, author..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2">
                                    <select name="category" class="form-select">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="author" class="form-select">
                                        <option value="">All Authors</option>
                                        @foreach($authors as $author)
                                            <option value="{{ $author->AuthorID }}" {{ request('author') == $author->AuthorID ? 'selected' : '' }}>
                                                {{ $author->FirstName }} {{ $author->LastName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="publisher" class="form-select">
                                        <option value="">All Publishers</option>
                                        @foreach($publishers as $publisher)
                                            <option value="{{ $publisher->publisher_id }}" {{ request('publisher') == $publisher->publisher_id ? 'selected' : '' }}>
                                                {{ $publisher->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="sort_by" class="form-select">
                                        <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Latest
                                            First</option>
                                        <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Oldest
                                            First</option>
                                        <option value="title_asc" {{ request('sort_by') == 'title_asc' ? 'selected' : '' }}>
                                            Title (A-Z)</option>
                                        <option value="title_desc" {{ request('sort_by') == 'title_desc' ? 'selected' : '' }}>
                                            Title (Z-A)</option>
                                        <option value="popular" {{ request('sort_by') == 'popular' ? 'selected' : '' }}>Most
                                            Popular</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="lni lni-search-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="card-style mb-30 shadow-sm border-0 rounded-4">
                            <!-- [Search block already exists above this, we are targeting the table wrapper] -->
                            <div class="title d-flex flex-wrap align-items-center justify-content-between mb-3">
                                <div class="left">
                                    <h6 class="text-medium text-muted"><i class="lni lni-library"></i> Book Management</h6>
                                </div>
                                <div class="right">
                                    <a href="#" class="main-btn primary-btn btn-hover btn-sm rounded-pill px-4" data-bs-toggle="modal"
                                        data-bs-target="#addBookModal">
                                        <i class="lni lni-plus mr-5"></i> Add Book
                                    </a>
                                </div>
                            </div>
                            <div class="table-wrapper table-responsive">
                                <table class="table top-selling-table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th><h6 class="text-sm text-medium text-muted">ID</h6></th>
                                            <th><h6 class="text-sm text-medium text-muted">Cover</h6></th>
                                            <th><h6 class="text-sm text-medium text-muted">Title & ISBN</h6></th>
                                            <th><h6 class="text-sm text-medium text-muted">Author</h6></th>
                                            <th><h6 class="text-sm text-medium text-muted">Category</h6></th>
                                            <th><h6 class="text-sm text-medium text-muted">Publisher</h6></th>
                                            <th class="text-center"><h6 class="text-sm text-medium text-muted">Action</h6></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($books as $key => $book)
                                            <tr>
                                                <td><p class="text-sm text-muted">{{ $key + 1 }}</p></td>
                                                <td>
                                                    @if($book->image)
                                                        <img src="{{ asset($book->image) }}" alt="cover" class="rounded shadow-sm" style="width: 45px; height: 60px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted shadow-sm" style="width: 45px; height: 60px;">
                                                            <i class="lni lni-image"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold text-dark mb-0">{{ Str::limit($book->title, 30) }}</p>
                                                    <p class="text-xs text-muted mb-0">ISBN: {{ $book->isbn }}</p>
                                                </td>
                                                <td><p class="text-sm text-muted">{{ $book->author->FirstName ?? '' }} {{ $book->author->LastName ?? '' }}</p></td>
                                                <td><span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">{{ $book->category->name ?? '' }}</span></td>
                                                <td><p class="text-sm text-muted">{{ $book->publisher->name ?? '' }}</p></td>
                                                <td class="text-center">
                                                    <div class="action d-flex justify-content-center gap-3">
                                                        <a href="#" class="text-primary edit-btn" data-bs-toggle="modal"
                                                            data-bs-target="#editBookModal" data-id="{{ $book->book_id }}"
                                                            data-title="{{ $book->title }}" data-isbn="{{ $book->isbn }}"
                                                            data-author="{{ $book->author_id }}" data-category="{{ $book->category_id }}"
                                                            data-publisher="{{ $book->publisher_id }}" data-year="{{ $book->publish_year }}"
                                                            data-desc="{{ $book->description }}" data-price="{{ $book->price }}"
                                                            data-quantity="{{ $book->quantity }}" data-image="{{ $book->image }}" style="font-size: 1.2rem;">
                                                            <i class="lni lni-pencil-alt"></i>
                                                        </a>
                                                        <a onclick="return confirm('Are you sure you want to delete this book?')"
                                                            href="{{ route('book.delete', $book->book_id) }}" class="text-danger" style="font-size: 1.2rem;">
                                                            <i class="lni lni-trash-can"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                Showing {{ $books->firstItem() ?? 0 }} to {{ $books->lastItem() ?? 0 }} of
                                {{ $books->total() }} books
                            </div>
                            <div>
                                {{ $books->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Book Modal -->
            <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addBookModalLabel">Add Book</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="title" value="{{ old('title') }}" required>
                                        @error('title')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="isbn" class="form-label">ISBN</label>
                                        <input type="text" class="form-control @error('isbn') is-invalid @enderror"
                                            id="isbn" name="isbn" value="{{ old('isbn') }}">
                                        @error('isbn')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="author_id" class="form-label">Author</label>
                                        <select class="form-select @error('author_id') is-invalid @enderror" id="author_id"
                                            name="author_id" required>
                                            <option value="" selected disabled>Select Author</option>
                                            @foreach($authors as $author)
                                                <option value="{{ $author->AuthorID }}" {{ old('author_id') == $author->AuthorID ? 'selected' : '' }}>
                                                    {{ $author->FirstName }} {{ $author->LastName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('author_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select class="form-select @error('category_id') is-invalid @enderror"
                                            id="category_id" name="category_id" required>
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="publisher_id" class="form-label">Publisher</label>
                                        <select class="form-select @error('publisher_id') is-invalid @enderror"
                                            id="publisher_id" name="publisher_id" required>
                                            <option value="" selected disabled>Select Publisher</option>
                                            @foreach($publishers as $publisher)
                                                <option value="{{ $publisher->publisher_id }}" {{ old('publisher_id') == $publisher->publisher_id ? 'selected' : '' }}>
                                                    {{ $publisher->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('publisher_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="publish_year" class="form-label">Publish Year</label>
                                        <input type="text" class="form-control" id="publish_year" name="publish_year"
                                            value="{{ old('publish_year') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" step="0.01" class="form-control" id="price" name="price"
                                            value="{{ old('price') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                            id="quantity" name="quantity" value="{{ old('quantity') }}" required>
                                        @error('quantity')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Book Cover</label>
                                    <input type="file" class="form-control" id="image" name="image">
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

            <!-- Edit Book Modal -->
            <div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('book.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="edit_id">
                            <input type="hidden" name="old_image" id="edit_old_image">

                            <div class="modal-header">
                                <h5 class="modal-title" id="editBookModalLabel">Edit Book</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="edit_title" name="title" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_isbn" class="form-label">ISBN</label>
                                        <input type="text" class="form-control" id="edit_isbn" name="isbn">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="edit_author_id" class="form-label">Author</label>
                                        <select class="form-select" id="edit_author_id" name="author_id" required>
                                            @foreach($authors as $author)
                                                <option value="{{ $author->AuthorID }}">{{ $author->FirstName }}
                                                    {{ $author->LastName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="edit_category_id" class="form-label">Category</label>
                                        <select class="form-select" id="edit_category_id" name="category_id" required>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="edit_publisher_id" class="form-label">Publisher</label>
                                        <select class="form-select" id="edit_publisher_id" name="publisher_id" required>
                                            @foreach($publishers as $publisher)
                                                <option value="{{ $publisher->publisher_id }}">{{ $publisher->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="edit_publish_year" class="form-label">Publish Year</label>
                                        <input type="text" class="form-control" id="edit_publish_year" name="publish_year">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="edit_price" class="form-label">Price</label>
                                        <input type="number" step="0.01" class="form-control" id="edit_price" name="price">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="edit_quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" id="edit_quantity" name="quantity"
                                            required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_description" class="form-label">Description</label>
                                    <textarea class="form-control" id="edit_description" name="description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_image" class="form-label">Book Cover</label>
                                    <input type="file" class="form-control" id="edit_image" name="image">
                                    <img src="" id="show_image" style="width: 50px; margin-top: 10px;">
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
            var editTitleInput = document.getElementById("edit_title");
            var editIsbnInput = document.getElementById("edit_isbn");
            var editAuthorInput = document.getElementById("edit_author_id");
            var editCategoryInput = document.getElementById("edit_category_id");
            var editPublisherInput = document.getElementById("edit_publisher_id");
            var editYearInput = document.getElementById("edit_publish_year");
            var editDescInput = document.getElementById("edit_description");
            var editPriceInput = document.getElementById("edit_price");
            var editQuantityInput = document.getElementById("edit_quantity");
            var editOldImageInput = document.getElementById("edit_old_image");
            var showImage = document.getElementById("show_image");

            editButtons.forEach(function (button) {
                button.addEventListener("click", function () {
                    var id = this.getAttribute("data-id");
                    var title = this.getAttribute("data-title");
                    var isbn = this.getAttribute("data-isbn");
                    var author = this.getAttribute("data-author");
                    var category = this.getAttribute("data-category");
                    var publisher = this.getAttribute("data-publisher");
                    var year = this.getAttribute("data-year");
                    var desc = this.getAttribute("data-desc");
                    var price = this.getAttribute("data-price");
                    var quantity = this.getAttribute("data-quantity");
                    var image = this.getAttribute("data-image");

                    // Populate fields
                    editIdInput.value = id;
                    editTitleInput.value = title;
                    editIsbnInput.value = isbn;
                    editAuthorInput.value = author;
                    editCategoryInput.value = category;
                    editPublisherInput.value = publisher;
                    editYearInput.value = year;
                    editDescInput.value = desc;
                    editPriceInput.value = price;
                    editQuantityInput.value = quantity;
                    editOldImageInput.value = image;

                    if (image) {
                        showImage.src = "{{ asset('/') }}" + image;
                    } else {
                        showImage.src = "";
                    }
                });
            });
        });
    </script>
@endsection