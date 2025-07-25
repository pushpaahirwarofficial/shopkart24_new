

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Add the Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link rel="apple-touch-icon" href="{{ asset('assets/website/images/fav.png') }}">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/fonts/boxicons.css') }}" />

<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/css/core.css') }}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/demo.css') }}" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

<!-- Page CSS -->
<!-- Page -->
<link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/css/pages/page-auth.css') }}" />

<!-- Helpers -->
<script src="{{ asset('assets/dashboard/vendor/js/helpers.js') }}"></script>
<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="{{ asset('assets/dashboard/js/config.js') }}"></script>

</head>

<body>

    <!-- Header Section -->
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Home</a>
        </div>
    </nav>

                        <!--<form method="post" action="{{ route('admin.login') }}">-->
    <!-- Login Form Section -->
 <div class="container-xxl">
<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner-login">

        <!-- Register -->
        <div class="card">
            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <a href="/" class="app-brand-link gap-2">
                        <span><img src="{{ asset('/assets/dashboard/img/Logo.png') }}" alt="" width="150px"></span>
                    </a>
                </div>
                <!-- /Logo -->
                <!-- <h4 class="mb-2">Welcome to Admin Login! 👋</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p> -->

                        <form method="post" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username"
                            autofocus />
                      
                        <div class="invalid-feedback">
                           
                        </div>
                      
                    </div>
                    <div class="mb-3 form-password-toggle">
                     
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                            <a href="">
                                <small>Forgot Password?</small>
                            </a>
                        </div>
                      
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
                            <label class="form-check-label" for="remember-me"> Remember Me </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit">Sign
                            in</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Register -->
    </div>
</div>
</div>
    <!-- Add jQuery first, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script src="{{ asset('assets/dashboard/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendor/js/menu.js') }}"></script>

<!-- endbuild -->

<!-- Vendors JS -->

<!-- Main JS -->
<script src="{{ asset('assets/dashboard/js/main.js') }}"></script>
<!-- <script src="{{ asset('assets/dashboard/js/api.js') }}"></script> -->

    
</body>

</html>