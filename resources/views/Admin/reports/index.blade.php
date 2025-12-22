@extends('Admin.admin_master')
@section('Admin')
    <section class="page-content">
        <div class="container-fluid mt-4">
            <div class="title d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Reports & Analytics</h4>
                <div class="buttons">
                    <a href" class="main-btn primary-btn btn-hover btn-sm">
                        <i class="lni lni-download me-2"></i> Export CSV
                    </a>
                    <a href="" class="main-btn success-btn btn-hover btn-sm">
                        <i class="lni lni-printer me-2"></i> Export PDF
                    </a>
                    
                </div>
            </div>

            <!-- Summary Tiles -->
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon primary"><i class="lni lni-library"></i></div>
                        <div class="content">
                            <h6 class="mb-10">Total Inventory</h6>
                            <h3 class="text-bold mb-10">{{ $inventoryStats['total'] }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon orange"><i class="lni lni-warning"></i></div>
                        <div class="content">
                            <h6 class="mb-10">Missing / Damaged</h6>
                            <h3 class="text-bold mb-10">{{ $inventoryStats['missing'] + $inventoryStats['damaged'] }}</h3>
                            <p class="text-sm">M: {{ $inventoryStats['missing'] }} | D: {{ $inventoryStats['damaged'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon success"><i class="lni lni-checkmark-circle"></i></div>
                        <div class="content">
                            <h6 class="mb-10">Available Now</h6>
                            <h3 class="text-bold mb-10">{{ $inventoryStats['total'] - ($inventoryStats['borrowed'] + $inventoryStats['missing'] + $inventoryStats['damaged']) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon danger"><i class="lni lni-timer"></i></div>
                        <div class="content">
                            <h6 class="mb-10">Overdue Items</h6>
                            <h3 class="text-bold mb-10">{{ count($overdueItems) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Usage Trends Chart -->
                <div class="col-lg-7">
                    <div class="card-style mb-30">
                        <div class="title d-flex justify-content-between align-items-center">
                            <h6 class="mb-10">Usage Trends (Last 7 Days)</h6>
                        </div>
                        <div class="chart">
                            <canvas id="usageChart" style="width: 100%; height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Popular Books Table -->
                <div class="col-lg-5">
                    <div class="card-style mb-30">
                        <h6 class="mb-10">Popular Books</h6>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Book Title</th>
                                        <th>Borrows</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($popularBooks as $book)
                                        <tr>
                                            <td><p>{{ $book->title }}</p></td>
                                            <td><p>{{ $book->borrows_count }}</p></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Overdue Items Table -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <h6 class="mb-10">Overdue Items Detailed List</h6>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Book</th>
                                        <th>Due Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($overdueItems as $item)
                                        <tr>
                                            <td><p>{{ $item->user->name }}</p></td>
                                            <td><p>{{ $item->book->title }}</p></td>
                                            <td><p class="text-danger">{{ \Carbon\Carbon::parse($item->due_date)->format('M d, Y') }}</p></td>
                                            <td>
                                                <div class="action">
                                                    <a href="{{ route('admin.borrows') }}" class="text-primary">Manage</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if($overdueItems->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">No overdue items found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('backend/assets/js/Chart.min.js') }}"></script>
    <script>
        const ctxUsage = document.getElementById('usageChart').getContext('2d');
        const usageChart = new Chart(ctxUsage, {
            type: 'line',
            data: {
                labels: {!! json_encode($usageTrend->pluck('date')->reverse()->values()) !!},
                datasets: [{
                    label: 'Daily Borrows',
                    data: {!! json_encode($usageTrend->pluck('count')->reverse()->values()) !!},
                    borderColor: '#365CF5',
                    backgroundColor: 'rgba(54, 92, 245, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });
    </script>
@endsection
