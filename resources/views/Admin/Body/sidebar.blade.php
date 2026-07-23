<aside class="sidebar-nav-wrapper ">
  <div class="navbar-logo">
    <a href="#" class="d-flex align-items-center gap-2 text-decoration-none">
      <img src="{{ asset('backend/assets/images/logo/book.png') }}" alt="logo" width="32" height="32">

      <span class="fw-bold fs-5">Library System</span>
    </a>
  </div>
  <nav class="sidebar-nav">
    <ul>
      <li class="nav-item ">
        <a href="{{ route('dashboard') }}">
          <span class="icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M8.74999 18.3333C12.2376 18.3333 15.1364 15.8128 15.7244 12.4941C15.8448 11.8143 15.2737 11.25 14.5833 11.25H9.99999C9.30966 11.25 8.74999 10.6903 8.74999 10V5.41666C8.74999 4.7263 8.18563 4.15512 7.50586 4.27556C4.18711 4.86357 1.66666 7.76243 1.66666 11.25C1.66666 15.162 4.83797 18.3333 8.74999 18.3333Z" />
              <path
                d="M17.0833 10C17.7737 10 18.3432 9.43708 18.2408 8.75433C17.7005 5.14918 14.8508 2.29947 11.2457 1.75912C10.5629 1.6568 10 2.2263 10 2.91665V9.16666C10 9.62691 10.3731 10 10.8333 10H17.0833Z" />
            </svg>
          </span>
          <span class="text">Dashboard</span>
        </a>

      </li>
      <li class="nav-item nav-item-has-children">
        <a href="#0" class="{{ Route::is('admin.book') || Route::is('admin.category') || Route::is('admin.publisher') || Route::is('admin.author') ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#ddmenu_catalog" aria-controls="ddmenu_catalog"
          aria-expanded="{{ Route::is('admin.book') || Route::is('admin.category') || Route::is('admin.publisher') || Route::is('admin.author') ? 'true' : 'false' }}" aria-label="Toggle navigation">
          <span class="icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5 2C3.34315 2 2 3.34315 2 5V17C2 17.5523 2.44772 18 3 18H5V2Z" />
              <path d="M7 18H17C17.5523 18 18 17.5523 18 17V5C18 3.34315 16.6569 2 15 2H7V18Z" />
              <path width="2" height="2" x="14" y="4" rx="1" fill="currentColor" opacity="0.5" />
            </svg>
          </span>
          <span class="text">Catalog Management</span>
        </a>
        <ul id="ddmenu_catalog" class="collapse dropdown-nav {{ Route::is('admin.book') || Route::is('admin.category') || Route::is('admin.publisher') || Route::is('admin.author') ? 'show' : '' }}">
          <li>
            <a href="{{ route('admin.book') }}" class="{{ Route::is('admin.book') ? 'active' : '' }}"> Books </a>
          </li>
          <li>
            <a href="{{ route('admin.category') }}" class="{{ Route::is('admin.category') ? 'active' : '' }}"> Categories </a>
          </li>
          <li>
            <a href="{{ route('admin.publisher') }}" class="{{ Route::is('admin.publisher') ? 'active' : '' }}"> Publishers </a>
          </li>
          <li>
            <a href="{{ route('admin.author') }}" class="{{ Route::is('admin.author') ? 'active' : '' }}"> Authors </a>
          </li>
          <li>
            <a href="{{ route('admin.reviews') }}" class="{{ Route::is('admin.reviews') ? 'active' : '' }}"> Reviews </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.user.management') }}" class="{{ Route::is('admin.user.management') ? 'active' : '' }}">
          <span class="icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M3.33334 3.35442C3.33334 2.4223 4.07954 1.66666 5.00001 1.66666H15C15.9205 1.66666 16.6667 2.4223 16.6667 3.35442V16.8565C16.6667 17.5519 15.8827 17.9489 15.3333 17.5317L13.8333 16.3924C13.537 16.1673 13.1297 16.1673 12.8333 16.3924L10.5 18.1646C10.2037 18.3896 9.79634 18.3896 9.50001 18.1646L7.16668 16.3924C6.87038 16.1673 6.46298 16.1673 6.16668 16.3924L4.66668 17.5317C4.11731 17.9489 3.33334 17.5519 3.33334 16.8565V3.35442ZM4.79168 5.04218C4.79168 5.39173 5.0715 5.6751 5.41668 5.6751H10C10.3452 5.6751 10.625 5.39173 10.625 5.04218C10.625 4.69264 10.3452 4.40927 10 4.40927H5.41668C5.0715 4.40927 4.79168 4.69264 4.79168 5.04218ZM5.41668 7.7848C5.0715 7.7848 4.79168 8.06817 4.79168 8.41774C4.79168 8.76724 5.0715 9.05066 5.41668 9.05066H10C10.3452 9.05066 10.625 8.76724 10.625 8.41774C10.625 8.06817 10.3452 7.7848 10 7.7848H5.41668ZM4.79168 11.7932C4.79168 12.1428 5.0715 12.4262 5.41668 12.4262H10C10.3452 12.4262 10.625 12.1428 10.625 11.7932C10.625 11.4437 10.3452 11.1603 10 11.1603H5.41668C5.0715 11.1603 4.79168 11.4437 4.79168 11.7932ZM13.3333 4.40927C12.9882 4.40927 12.7083 4.69264 12.7083 5.04218C12.7083 5.39173 12.9882 5.6751 13.3333 5.6751H14.5833C14.9285 5.6751 15.2083 5.39173 15.2083 5.04218C15.2083 4.69264 14.9285 4.40927 14.5833 4.40927H13.3333ZM12.7083 8.41774C12.7083 8.76724 12.9882 9.05066 13.3333 9.05066H14.5833C14.9285 9.05066 15.2083 8.76724 15.2083 8.41774C15.2083 8.06817 14.9285 7.7848 14.5833 7.7848H13.3333C12.9882 7.7848 12.7083 8.06817 12.7083 8.41774ZM13.3333 11.1603C12.9882 11.1603 12.7083 11.4437 12.7083 11.7932C12.7083 12.1428 12.9882 12.4262 13.3333 12.4262H14.5833C14.9285 12.4262 15.2083 12.1428 15.2083 11.7932C15.2083 11.4437 14.9285 11.1603 14.5833 11.1603H13.3333Z" />
            </svg>
          </span>
          <span class="text">User Management</span>
        </a>
      </li>

      <li class="nav-item nav-item-has-children">
        <a href="#0" class="{{ Route::is('admin.borrows*') || Route::is('admin.reservations') ? '' : 'collapsed' }}" data-bs-toggle="collapse"
          data-bs-target="#ddmenu_borrow" aria-controls="ddmenu_borrow"
          aria-expanded="{{ Route::is('admin.borrows*') || Route::is('admin.reservations') ? 'true' : 'false' }}" aria-label="Toggle navigation">
          <span class="icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M10 18.3333C10 18.3333 1.66666 16.6667 1.66666 10V3.33334L10 1.66667L18.3333 3.33334V10C18.3333 16.6667 10 18.3333 10 18.3333Z"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M10 5.83334V10.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
              <path d="M7.5 8.33334L10 10.8333L12.5 8.33334" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </span>
          <span class="text">Borrow Management</span>
        </a>
        <ul id="ddmenu_borrow" class="collapse dropdown-nav {{ Route::is('admin.borrows*') || Route::is('admin.reservations') ? 'show' : '' }}">
          <li>
            <a href="{{ route('admin.borrows.books') }}" class="{{ Route::is('admin.borrows.books') ? 'active' : '' }}"> Issue Book (Cards) </a>
          </li>
          <li>
            <a href="{{ route('admin.borrows') }}" class="{{ Route::is('admin.borrows') ? 'active' : '' }}"> View Borrows & Fines </a>
          </li>
          <li>
            <a href="{{ route('admin.reservations') }}" class="{{ Route::is('admin.reservations') ? 'active' : '' }}"> Book Reservations </a>
          </li>
        </ul>
      </li>

      <!-- Fine & Payments -->
      <li class="nav-item">
        <a href="{{ route('admin.borrows', ['status' => 'overdue']) }}" class="{{ Route::is('admin.borrows') && request('status') === 'overdue' ? 'active' : '' }}">
          <span class="icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 1.66667C5.39763 1.66667 1.66667 5.39763 1.66667 10C1.66667 14.6024 5.39763 18.3333 10 18.3333C14.6024 18.3333 18.3333 14.6024 18.3333 10C18.3333 5.39763 14.6024 1.66667 10 1.66667ZM10 5C10.4602 5 10.8333 5.37310 10.8333 5.83333V10C10.8333 10.4602 10.4602 10.8333 10 10.8333C9.53977 10.8333 9.16667 10.4602 9.16667 10V5.83333C9.16667 5.37310 9.53977 5 10 5ZM10 13.3333C9.53977 13.3333 9.16667 12.9602 9.16667 12.5C9.16667 12.0398 9.53977 11.6667 10 11.6667C10.4602 11.6667 10.8333 12.0398 10.8333 12.5C10.8333 12.9602 10.4602 13.3333 10 13.3333Z"/>
            </svg>
          </span>
          <span class="text">Fine & Payments</span>
        </a>
      </li>

      <!-- Activity Reports -->
      <li class="nav-item">
        <a href="{{ route('admin.reports') }}" class="{{ Route::is('admin.reports') ? 'active' : '' }}">
          <span class="icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16.6667 2.5H3.33333C2.41286 2.5 1.66667 3.24619 1.66667 4.16667V15.8333C1.66667 16.7538 2.41286 17.5 3.33333 17.5H16.6667C17.5871 17.5 18.3333 16.7538 18.3333 15.8333V4.16667C18.3333 3.24619 17.5871 2.5 16.6667 2.5ZM5.83333 13.3333C5.37310 13.3333 5 12.9602 5 12.5C5 12.0398 5.37310 11.6667 5.83333 11.6667C6.29357 11.6667 6.66667 12.0398 6.66667 12.5C6.66667 12.9602 6.29357 13.3333 5.83333 13.3333ZM5.83333 10C5.37310 10 5 9.62690 5 9.16667C5 8.70643 5.37310 8.33333 5.83333 8.33333C6.29357 8.33333 6.66667 8.70643 6.66667 9.16667C6.66667 9.62690 6.29357 10 5.83333 10ZM5.83333 6.66667C5.37310 6.66667 5 6.29357 5 5.83333C5 5.37310 5.37310 5 5.83333 5C6.29357 5 6.66667 5.37310 6.66667 5.83333C6.66667 6.29357 6.29357 6.66667 5.83333 6.66667ZM15 13.3333H8.33333C7.87310 13.3333 7.5 12.9602 7.5 12.5C7.5 12.0398 7.87310 11.6667 8.33333 11.6667H15C15.4602 11.6667 15.8333 12.0398 15.8333 12.5C15.8333 12.9602 15.4602 13.3333 15 13.3333ZM15 10H8.33333C7.87310 10 7.5 9.62690 7.5 9.16667C7.5 8.70643 7.87310 8.33333 8.33333 8.33333H15C15.4602 8.33333 15.8333 8.70643 15.8333 9.16667C15.8333 9.62690 15.4602 10 15 10ZM15 6.66667H8.33333C7.87310 6.66667 7.5 6.29357 7.5 5.83333C7.5 5.37310 7.87310 5 8.33333 5H15C15.4602 5 15.8333 5.37310 15.8333 5.83333C15.8333 6.29357 15.4602 6.66667 15 6.66667Z"/>
            </svg>
          </span>
          <span class="text">Activity Reports</span>
        </a>
      </li>

      <!-- System Settings -->
      <li class="nav-item">
        <a href="{{ route('admin.settings') }}" class="{{ Route::is('admin.settings') ? 'active' : '' }}">
          <span class="icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1.66667C10.4602 1.66667 10.8333 2.03976 10.8333 2.5V3.37027C11.5254 3.54688 12.1747 3.84427 12.7539 4.24023L13.3839 3.61035C13.709 3.28522 14.2364 3.28522 14.5615 3.61035L16.3896 5.43848C16.7148 5.76361 16.7148 6.29102 16.3896 6.61621L15.7598 7.24609C16.1557 7.82529 16.4531 8.47461 16.6297 9.16667H17.5C17.9602 9.16667 18.3333 9.53976 18.3333 10C18.3333 10.4602 17.9602 10.8333 17.5 10.8333H16.6297C16.4531 11.5254 16.1557 12.1747 15.7598 12.7539L16.3896 13.3838C16.7148 13.709 16.7148 14.2363 16.3896 14.5615L14.5615 16.3896C14.2364 16.7148 13.709 16.7148 13.3839 16.3896L12.7539 15.7598C12.1747 16.1557 11.5254 16.4531 10.8333 16.6296V17.5C10.8333 17.9602 10.4602 18.3333 10 18.3333C9.53977 18.3333 9.16667 17.9602 9.16667 17.5V16.6296C8.47461 16.4531 7.82529 16.1557 7.24609 15.7598L6.61621 16.3896C6.29102 16.7148 5.76361 16.7148 5.43848 16.3896L3.61035 14.5615C3.28522 14.2363 3.28522 13.709 3.61035 13.3838L4.24023 12.7539C3.84427 12.1747 3.54688 11.5254 3.37027 10.8333H2.5C2.03976 10.8333 1.66667 10.4602 1.66667 10C1.66667 9.53976 2.03976 9.16667 2.5 9.16667H3.37027C3.54688 8.47461 3.84427 7.82529 4.24023 7.24609L3.61035 6.61621C3.28522 6.29102 3.28522 5.76361 3.61035 5.43848L5.43848 3.61035C5.76361 3.28522 6.29102 3.28522 6.61621 3.61035L7.24609 4.24023C7.82529 3.84427 8.47461 3.54688 9.16667 3.37027V2.5C9.16667 2.03976 9.53977 1.66667 10 1.66667ZM10 7.5C8.61929 7.5 7.5 8.61929 7.5 10C7.5 11.3807 8.61929 12.5 10 12.5C11.3807 12.5 12.5 11.3807 12.5 10C12.5 8.61929 11.3807 7.5 10 7.5Z"/>
            </svg>
          </span>
          <span class="text">System Settings</span>
        </a>
      </li>

      <span class="divider"><hr /></span>

      <li class="nav-item">
        <a href="{{ route('home') }}" target="_blank">
          <span class="icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10.8333 2.50008C10.8333 2.03984 10.4602 1.66675 9.99999 1.66675C9.53975 1.66675 9.16666 2.03984 9.16666 2.50008C9.16666 2.96032 9.53975 3.33341 9.99999 3.33341C10.4602 3.33341 10.8333 2.96032 10.8333 2.50008Z" />
              <path d="M17.5 5.41673C17.5 7.02756 16.1942 8.33339 14.5833 8.33339C12.9725 8.33339 11.6667 7.02756 11.6667 5.41673C11.6667 3.80589 12.9725 2.50006 14.5833 2.50006C16.1942 2.50006 17.5 3.80589 17.5 5.41673Z" />
              <path d="M11.4272 2.69637C10.9734 2.56848 10.4947 2.50006 10 2.50006C7.10054 2.50006 4.75003 4.85057 4.75003 7.75006V9.20873C4.75003 9.72814 4.62082 10.2393 4.37404 10.6963L3.36705 12.5611C2.89938 13.4272 3.26806 14.5081 4.16749 14.9078C7.88074 16.5581 12.1193 16.5581 15.8326 14.9078C16.732 14.5081 17.1007 13.4272 16.633 12.5611L15.626 10.6963C15.43 10.3333 15.3081 9.93606 15.2663 9.52773C15.0441 9.56431 14.8159 9.58339 14.5833 9.58339C12.2822 9.58339 10.4167 7.71791 10.4167 5.41673C10.4167 4.37705 10.7975 3.42631 11.4272 2.69637Z" />
              <path d="M7.48901 17.1925C8.10004 17.8918 8.99841 18.3335 10 18.3335C11.0016 18.3335 11.9 17.8918 12.511 17.1925C10.8482 17.4634 9.15183 17.4634 7.48901 17.1925Z" />
            </svg>
          </span>
          <span class="text">Member Portal <i class="lni lni-arrow-right"></i></span>
        </a>
      </li>
    </ul>
  </nav>
  <div class="promo-box">
    <div class="promo-icon">


      <img class="rounded-circle"
        src="{{ (!empty(Auth::user()->profile_image)) ? url('upload/admin_images/' . Auth::user()->profile_image) : url('upload/image.png') }}"
        alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    <h3>{{ Auth::user()->name }}</h3>
    <p>{{ Auth::user()->email }}</p>

    <a href="{{ route('admin.logout') }}" target="_blank" rel="nofollow" class="main-btn primary-btn btn-hover">
      Logout
    </a>
  </div>
</aside>