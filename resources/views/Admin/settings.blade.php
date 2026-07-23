@extends('Admin.admin_master')
@section('Admin')
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card-style mb-30 shadow-sm border-0 rounded-4">
                <div class="title d-flex flex-wrap justify-content-between mb-4">
                    <div class="left">
                        <h6 class="text-medium text-muted"><i class="lni lni-cog"></i> System Settings</h6>
                    </div>
                </div>

                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    
                    <div class="input-style-1">
                        <label>Library Name</label>
                        <input type="text" name="library_name" placeholder="e.g. Central Library" value="{{ $settings['library_name'] ?? 'Library Management System' }}" />
                    </div>

                    <div class="input-style-1">
                        <label>Contact Email</label>
                        <input type="email" name="contact_email" placeholder="admin@example.com" value="{{ $settings['contact_email'] ?? 'admin@library.com' }}" />
                    </div>

                    <div class="input-style-1">
                        <label>Fine Per Day (in cents or local currency amount)</label>
                        <input type="number" step="0.01" name="fine_per_day" placeholder="0.50" value="{{ $settings['fine_per_day'] ?? '0.50' }}" />
                        <span class="text-sm text-muted mt-1 d-block">This value is used by the automated fine calculator.</span>
                    </div>

                    <div class="input-style-1">
                        <label>Max Borrow Days</label>
                        <input type="number" name="max_borrow_days" placeholder="14" value="{{ $settings['max_borrow_days'] ?? '14' }}" />
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="main-btn primary-btn btn-hover rounded-pill px-4">
                            Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
