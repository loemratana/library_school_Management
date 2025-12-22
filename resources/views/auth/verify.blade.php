<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/book.png') }}" type="image/x-icon" />
    <title>Verification Page</title>

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
    <div class="overlay"></div>

    <section class="signin-section">
        <div class="container">
            <!-- Title wrapper -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Sign in</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#">Auth</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Sign in</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-0 auth-row">
                <div class="col-lg-6">
                    <div class="auth-cover-wrapper bg-primary-100">
                        <div class="auth-cover">
                            <div class="title text-center">
                                <h1 class="mb-10 text-white">Welcome Back</h1>
                                <p class="text-medium text-white">
                                    Sign in to your Existing account to continue
                                </p>
                            </div>
                            <div class="cover-image">
                                <img src="{{ asset('backend/assets/images/auth/loginShap.png') }}" alt="" />
                            </div>
                            <div class="shape-image">
                                <img src="{{ asset('backend/assets/images/auth/image.png') }}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="signin-wrapper">
                        <div class="form-wrapper">
                            <h6 class="mb-15">Sign In Form</h6>
                            <p class="text-sm mb-25">Start creating the best possible user experience for your customers.</p>

                            <!-- Display validation errors -->
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <!-- Display session error -->
                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif

                            <form action="{{ route('custom.verification.verify') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Code</label>
                                            <input type="text" placeholder="Enter Your Code" name="code" id="code" required autofocus autocomplete="username" />
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="button-group d-flex justify-content-center flex-wrap">
                                            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                                Verify
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="singin-option pt-40">
                                <p class="text-sm text-medium text-center text-gray">Easy Sign In With</p>
                                <div class="button-group pt-40 pb-40 d-flex justify-content-center flex-wrap">
                                    <button class="main-btn primary-btn-outline m-2">
                                        <i class="lni lni-facebook-fill mr-10"></i> Facebook
                                    </button>
                                    <button class="main-btn danger-btn-outline m-2">
                                        <i class="lni lni-google mr-10"></i> Google
                                    </button>
                                </div>
                                <p class="text-sm text-medium text-dark text-center">
                                    Don’t have an account yet? <a href="{{ route('register') }}">Create an account</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========= All Javascript files linkup ======== -->
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