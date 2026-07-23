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

      <li class="nav-item nav-item-has-children">
        <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_55" aria-controls="ddmenu_55"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M5.48663 1.1466C5.77383 0.955131 6.16188 1.03274 6.35335 1.31994L6.87852 2.10769C7.20508 2.59755 7.20508 3.23571 6.87852 3.72556L6.35335 4.51331C6.16188 4.80052 5.77383 4.87813 5.48663 4.68666C5.19943 4.49519 5.12182 4.10715 5.31328 3.81994L5.83845 3.03219C5.88511 2.96221 5.88511 2.87105 5.83845 2.80106L5.31328 2.01331C5.12182 1.72611 5.19943 1.33806 5.48663 1.1466Z" />
              <path
                d="M2.49999 5.83331C2.03976 5.83331 1.66666 6.2064 1.66666 6.66665V10.8333C1.66666 13.5948 3.90523 15.8333 6.66666 15.8333H9.99999C12.1856 15.8333 14.0436 14.431 14.7235 12.4772C14.8134 12.4922 14.9058 12.5 15 12.5H16.6667C17.5872 12.5 18.3333 11.7538 18.3333 10.8333V8.33331C18.3333 7.41284 17.5872 6.66665 16.6667 6.66665H15C15 6.2064 14.6269 5.83331 14.1667 5.83331H2.49999ZM14.9829 11.2496C14.9942 11.1123 15 10.9735 15 10.8333V7.91665H16.6667C16.8967 7.91665 17.0833 8.10319 17.0833 8.33331V10.8333C17.0833 11.0634 16.8967 11.25 16.6667 11.25H15L14.9898 11.2498L14.9829 11.2496Z" />
              <path
                d="M8.85332 1.31994C8.6619 1.03274 8.27383 0.955131 7.98663 1.1466C7.69943 1.33806 7.62182 1.72611 7.81328 2.01331L8.33848 2.80106C8.38507 2.87105 8.38507 2.96221 8.33848 3.03219L7.81328 3.81994C7.62182 4.10715 7.69943 4.49519 7.98663 4.68666C8.27383 4.87813 8.6619 4.80052 8.85332 4.51331L9.37848 3.72556C9.70507 3.23571 9.70507 2.59755 9.37848 2.10769L8.85332 1.31994Z" />
              <path
                d="M10.4867 1.1466C10.7738 0.955131 11.1619 1.03274 11.3533 1.31994L11.8785 2.10769C12.2051 2.59755 12.2051 3.23571 11.8785 3.72556L11.3533 4.51331C11.1619 4.80052 10.7738 4.87813 10.4867 4.68666C10.1994 4.49519 10.1218 4.10715 10.3133 3.81994L10.8385 3.03219C10.8851 2.96221 10.8851 2.87105 10.8385 2.80106L10.3133 2.01331C10.1218 1.72611 10.1994 1.33806 10.4867 1.1466Z" />
              <path
                d="M2.49999 16.6667C2.03976 16.6667 1.66666 17.0398 1.66666 17.5C1.66666 17.9602 2.03976 18.3334 2.49999 18.3334H14.1667C14.6269 18.3334 15 17.9602 15 17.5C15 17.0398 14.6269 16.6667 14.1667 16.6667H2.49999Z" />
            </svg>
          </span>
          <span class="text">Reporting</span>
        </a>
        <ul id="ddmenu_55" class="collapse dropdown-nav {{ Route::is('admin.reports') ? 'show' : '' }}">
          <li>
            <a href="{{ route('admin.reports') }}" class="{{ Route::is('admin.reports') ? 'active' : '' }}"> Usage &
              Inventory </a>
          </li>
        </ul>
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