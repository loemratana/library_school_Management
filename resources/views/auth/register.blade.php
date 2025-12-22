<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="{{asset('backend/assets/images/book.png')}}" type="image/x-icon" />
  <title>Sign Up</title>

  <!-- ========== All CSS files linkup ========= -->
  <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/lineicons.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/fullcalendar.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/main.css') }}">

</head>

<body>
  <!-- ======== Preloader =========== -->
  <div id="preloader">
    <div class="spinner"></div>
  </div>
  <!-- ======== Preloader =========== -->
  <div class="overlay"></div>
  <!-- ======== sidebar-nav end =========== -->



  <!-- ========== signin-section start ========== -->
  <section class="signin-section">
    <div class="container">
      <!-- ========== title-wrapper start ========== -->
      <div class="title-wrapper pt-30">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="title">
              <h2>Sign up</h2>
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
                  <li class="breadcrumb-item"><a href="#0">Auth</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Sign up
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

      <div class="row g-0 auth-row">
        <div class="col-lg-6">
          <div class="auth-cover-wrapper bg-primary-100">
            <div class="auth-cover">
              <div class="title text-center">
                <h1 class="text-white mb-10">Get Started</h1>
                <p class="text-white">
                  Start creating the best possible user experience
                  <br class="d-sm-block" />
                  for you customers.
                </p>
              </div>
              <div class="cover-image">
                <img src="{{asset('backend/assets/images/auth/loginShap.png')}}" alt="" />
              </div>
              <div class="shape-image">
                <img src="{{asset('backend/assets/images/auth/image.png')}}" alt="" />
              </div>
            </div>
          </div>
        </div>
        <!-- end col -->
        <div class="col-lg-6">
          <div class="signup-wrapper">
            <div class="form-wrapper">
              <h6 class="mb-15">Sign Up Form</h6>
              <p class="text-sm mb-25">
                Start creating the best possible user experience for you
                customers.
              </p>
              <form method="POST" action="{{ route('register')}}">
                @csrf

                <div class="row">
                  <div class="col-12">
                    <div class="input-style-1">
                      <label>Name</label>
                      <input type="text" id="name" name="name" placeholder="Name" required autofocus
                        autocomplete="name" />
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-12">
                    <div class="input-style-1">
                      <label>Email</label>
                      <input type="email" id="email" name="email" placeholder="Email" required
                        autocomplete="username" />
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-12">
                    <div class="input-style-1">
                      <label>Password</label>
                      <input type="password" id="password" name="password" required autocomplete="new-password"
                        placeholder="Password" />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="input-style-1">
                      <label>Confirm Password</label>
                      <input id="password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password" />
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-12">
                    <div class="form-check checkbox-style mb-30">
                      <input class="form-check-input" type="checkbox" value="" id="checkbox-not-robot" />
                      <label class="form-check-label" for="checkbox-not-robot">
                        I'm not robot</label>
                    </div>
                  </div>
                  <!-- end col -->
                  <div class="col-12">
                    <div class="button-group d-flex justify-content-center flex-wrap">
                      <button class="main-btn primary-btn btn-hover w-100 text-center">
                        Sign Up
                      </button>
                    </div>
                  </div>
                </div>
                <!-- end row -->
              </form>

            </div>
          </div>
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->
    </div>
  </section>
  <!-- ========== signin-section end ========== -->



  <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/Chart.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/dynamic-pie-chart.js') }}"></script>
  <script src="{{ asset('backend/assets/js/moment.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/fullcalendar.js') }}"></script>
  <script src="{{ asset('backend/assets/js/jvectormap.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/world-merc.js') }}"></script>
  <script src="{{ asset('backend/assets/js/polyfill.js') }}"></script>
  <script src="{{ asset('backend/assets/js/main.js') }}"></script>
</body>

</html>