<!-- ========== header start ========== -->
<header class="header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-5 col-md-5 col-6">
        <div class="header-left d-flex align-items-center">
          <div class="menu-toggle-btn mr-15">
            <button id="menu-toggle" class="main-btn primary-btn btn-hover">
              <i class="lni lni-chevron-left me-2"></i> Menu
            </button>
          </div>
          <div class="header-search d-none d-md-flex">
            <form action="#">
              <input type="text" placeholder="Search..." />
              <button><i class="lni lni-search-alt"></i></button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-md-7 col-6">
        <div class="header-right">


          <!-- profile start -->
          <div class="profile-box ml-15">
            <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown"
              aria-expanded="false">
              <div class="profile-info">
                <div class="info">
                  <div class="image">
                    @php
                      $name = Auth::user()->name;
                      $parts = explode(' ', trim($name));
                      $initials = (count($parts) >= 2) ? strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1)) : strtoupper(substr($name, 0, 2));
                    @endphp

                    @if(!empty(Auth::user()->profile_image))
                      <img src="{{ url('upload/admin_images/' . Auth::user()->profile_image) }}" alt="Profile Image"
                        style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                      <div class="initials-avatar">{{ $initials }}</div>
                    @endif
                  </div>
                  <div>
                    <h6 class="fw-500">{{ Auth::user()->name }}</h6>
                    <p>{{ Auth::user()->role }}</p>
                  </div>
                </div>
              </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
              <li>
                <div class="author-info flex items-center !p-1">
                  <div class="image">
                    @if(!empty(Auth::user()->profile_image))
                      <img src="{{ url('upload/admin_images/' . Auth::user()->profile_image) }}" alt="Profile Image">
                    @else
                      <div class="initials-avatar">{{ $initials }}</div>
                    @endif
                  </div>
                  <div class="content">
                    <h4 class="text-sm">{{ Auth::user()->name }}</h4>
                    <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs"
                      href="#">{{ Auth::user()->email }}</a>
                  </div>
                </div>
              </li>
              <li class="divider"></li>
              <li>
                <a href="{{route('admin.profile')}}">
                  <i class="lni lni-user"></i> View Profile
                </a>
              </li>
              <li>
                <a href="#0">
                  <i class="lni lni-alarm"></i> Notifications
                </a>
              </li>
              <li>
                <a href="#0"> <i class="lni lni-inbox"></i> Messages </a>
              </li>
              <li>
                <a href="#0"> <i class="lni lni-cog"></i> Settings </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="{{ route('admin.logout') }}">
                  <i class="lni lni-exit"></i> Sign Out
                </a>
              </li>
            </ul>
          </div>
          <!-- profile end -->

        </div>
      </div>
    </div>
  </div>
</header>