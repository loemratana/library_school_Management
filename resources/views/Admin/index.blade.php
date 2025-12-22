@extends('Admin.admin_master')

@section('Admin')
  <section class="section">
    <div class="container-fluid">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="title">
              <h2>Libray Dashboard</h2>
            </div>
          </div>
          <!-- end col -->
          <div class="col-md-6">
            <div class="breadcrumb-wrapper">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#0">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    eCommerce
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
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="icon-card mb-30 shadow-sm border-0">
            <div class="icon purple">
              <i class="lni lni-book"></i>
            </div>
            <div class="content">
              <h6 class="mb-10 text-muted">Total Books</h6>
              <h3 class="text-bold mb-10">{{ $totalBooks }}</h3>
              <p class="text-sm text-success">
                <span class="text-gray">Total books in collection</span>
              </p>
            </div>
          </div>
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="icon-card mb-30 shadow-sm border-0">
            <div class="icon success">
              <i class="lni lni-users"></i>
            </div>
            <div class="content">
              <h6 class="mb-10 text-muted">Total Members</h6>
              <h3 class="text-bold mb-10">{{ $totalMembers }}</h3>
              <p class="text-sm text-success">
                <span class="text-gray">Registered members</span>
              </p>
            </div>
          </div>
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="icon-card mb-30 shadow-sm border-0">
            <div class="icon primary">
              <i class="lni lni-library"></i>
            </div>
            <div class="content">
              <h6 class="mb-10 text-muted">Books Borrowed</h6>
              <h3 class="text-bold mb-10">{{ $borrowedBooks }}</h3>
              <p class="text-sm text-primary">
                <span class="text-gray">Active transactions</span>
              </p>
            </div>
          </div>
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="icon-card mb-30 shadow-sm border-0">
            <div class="icon orange">
              <i class="lni lni-checkmark-circle"></i>
            </div>
            <div class="content">
              <h6 class="mb-10 text-muted">Books Available</h6>
              <h3 class="text-bold mb-10">{{ $availableBooks }}</h3>
              <p class="text-sm text-success">
                <span class="text-gray">Available for borrowing</span>
              </p>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="icon-card mb-30 shadow-sm border-0">
            <div class="icon danger">
              <i class="lni lni-warning"></i>
            </div>
            <div class="content">
              <h6 class="mb-10 text-muted">Overdue Books</h6>
              <h3 class="text-bold mb-10 text-danger">{{ $overdueBooks }}</h3>
              <p class="text-sm text-danger">
                <span class="text-gray">Requires immediate attention</span>
              </p>
            </div>
          </div>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="card-style mb-30 shadow-sm">
            <div class="title d-flex flex-wrap justify-content-between">
              <div class="left">
                <h6 class="text-medium mb-10 text-muted">Monthly Borrowing Activity</h6>
                <h3 class="text-bold">{{ $borrowedBooks }} Active</h3>
              </div>
            </div>
            <!-- End Title -->
            <div class="chart">
              <canvas id="Chart1" style="width: 100%; height: 350px;"></canvas>
            </div>
            <!-- End Chart -->
          </div>
        </div>
      </div>
      <!-- End Row -->
      <div class="row">
        <div class="col-lg-7">
          <div class="card-style mb-30 shadow-sm">
            <div class="title d-flex flex-wrap justify-content-between">
              <div class="left">
                <h6 class="text-medium mb-10 text-muted">Popular Books</h6>
                <h3 class="text-bold">Top 5</h3>
              </div>
            </div>
            <!-- End Title -->
            <div class="chart">
              <canvas id="Chart2" style="width: 100%; height: 350px;"></canvas>
            </div>
            <!-- End Chart -->
          </div>
        </div>
        <!-- End Col -->
        <div class="col-lg-5">
          <div class="card-style mb-30 shadow-sm">
            <div class="title d-flex flex-wrap align-items-center justify-content-between">
              <div class="left">
                <h6 class="text-medium mb-10 text-muted">Monthly Comparison</h6>
              </div>
            </div>
            <!-- End Title -->
            <div class="chart">
              <canvas id="Chart3" style="width: 100%; height: 350px;"></canvas>
              <div class="text-center mt-3">
                <span class="badge bg-primary">Borrows: {{ $thisMonthBorrows }}</span>
                <span class="badge bg-warning text-dark">Returns: {{ $thisMonthReturns }}</span>
              </div>
            </div>
            <!-- End Chart -->
          </div>
        </div>
      </div>
      <!-- End Row -->
      <div class="row">
        <div class="col-lg-7">
          <div class="card-style mb-30 shadow-sm">
            <div class="title d-flex flex-wrap align-items-center justify-content-between">
              <div class="left">
                <h6 class="text-medium mb-30 text-muted">Recent Borrowing Activity</h6>
              </div>
            </div>
            <!-- End Title -->
            <div class="table-responsive">
              <table class="table top-selling-table">
                <thead>
                  <tr>
                    <th>
                      <h6 class="text-sm text-medium">Book</h6>
                    </th>
                    <th class="min-width">
                      <h6 class="text-sm text-medium">
                        Member <i class="lni lni-arrows-vertical"></i>
                      </h6>
                    </th>
                    <th class="min-width">
                      <h6 class="text-sm text-medium">
                        Due Date <i class="lni lni-arrows-vertical"></i>
                      </h6>
                    </th>
                    <th class="min-width">
                      <h6 class="text-sm text-medium">
                        Status <i class="lni lni-arrows-vertical"></i>
                      </h6>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($recentBorrows as $borrow)
                    <tr>
                      <td>
                        <div class="product">
                          <p class="text-sm font-weight-bold">{{ $borrow->book->title }}</p>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm text-muted">{{ $borrow->user->name }}</p>
                      </td>
                      <td>
                        <p class="text-sm">{{ \Carbon\Carbon::parse($borrow->due_date)->format('M d, Y') }}</p>
                      </td>
                      <td>
                        @if($borrow->status == 'borrowed')
                          <span class="status-btn primary-btn py-1 px-3">Borrowed</span>
                        @elseif($borrow->status == 'overdue')
                          <span class="status-btn close-btn py-1 px-3">Overdue</span>
                        @elseif($borrow->status == 'returned')
                          <span class="status-btn success-btn py-1 px-3">Returned</span>
                        @endif
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="4" class="text-center py-4">No recent activity</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- End Row -->
    </div>
    <!-- end container -->
  </section>

@endsection