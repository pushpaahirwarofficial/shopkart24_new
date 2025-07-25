



<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    
    
    <!--================= Meta tag =================-->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

<title>User Profile</title>

<meta name="description" content="" />

 
<!-- Favicon -->
<link rel="apple-touch-icon" href="{{ asset('assets/website/images/fav.png') }}">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/fonts/boxicons.css') }}" />

<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/css/core.css') }}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/demo.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/flatpickr.css') }}" />
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> -->

<link rel="stylesheet" href="{{ asset('assets/dashboard/css/custom.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/website/fonts/elegant-icon.css') }}">

<link rel="stylesheet" href="{{ asset('assets/dashboard/css/message.css') }}" />


<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/libs/apex-charts/apex-charts.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/libs/fullcalendar/fullcalendar.css') }}" />
<link rel="stylesheet" href="{{ asset('/assets/dashboard/css/font-awesome.min.css')}}" />
<link href="{{ asset('/assets/dashboard/css/toastr.min.css')}}" rel="stylesheet">
<!-- Page CSS -->
<link href="{{ asset('/assets/dashboard/css/page-profile.css')}}" rel="stylesheet">
<link href="{{ asset('/assets/dashboard/css/calendar.css')}}" rel="stylesheet">
<link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


<!-- Helpers -->
<script src="{{ asset('assets/dashboard/vendor/js/helpers.js') }}"></script>
<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="{{ asset('assets/dashboard/js/config.js') }}"></script>

<!-- Js links-->
<script src="{{ asset('/assets/dashboard/js/jquery-3.7.0.min.js')}}"></script>
<script src="{{ asset('/assets/dashboard/js/toastr.min.js') }}"></script>
<!-- <script src="{{ asset('/assets/dashboard/js/jquery.validate.min.js')}}"></script>   -->
<script src="{{ asset('assets/dashboard/vendor/libs/jquery/jquery.js') }}"></script>

<script src="https://coderzo.in/external_api.js"></script>
<script src='https://8x8.vc/external_api.js'></script>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
 @stack('scripts')
 <style>
  .fc .fc-view-harness .fc-event .fc-event-title {
    color:white;
  }
  .floating-button-container {
        position: fixed;
        bottom: 100px;
        left: 20px;
        z-index: 1000;
    }

    .floating-button {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

</head>

<body>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M925QQDF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            
            <!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span><img src="{{ asset('/assets/dashboard/img/Logo.png') }}" alt="" height="50px" width="100%"></span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!--<li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">-->
        <!--    <a href="{{ Route('admin.dashboard') }}" class="menu-link">-->
        <!--<i class="menu-icon tf-icons bx bx-box"></i>-->
        <!--        <div data-i18n="Product">Product</div>-->
        <!--    </a>-->
        <!--</li>-->
        <!--<li class="menu-item {{ request()->is('admin/showcategory') ? 'active' : '' }}">-->
        <!--    <a href="{{ Route('admin.allcategory') }}" class="menu-link">-->
        <!--<i class="menu-icon tf-icons bx bx-category"></i>-->
        <!--        <div data-i18n="category">Category</div>-->
        <!--    </a>-->
        <!--</li>-->
        <!--<li class="menu-item {{ request()->is('admin/Showblog') ? 'active' : '' }}">-->
        <!--    <a href="{{ Route('admin.showBlog') }}" class="menu-link">-->
        <!--<i class="menu-icon tf-icons bx bx-news"></i>-->
        <!--        <div data-i18n="category">Blog</div>-->
        <!--    </a>-->
        <!--</li>-->
        <li class="menu-item ">
            <a href="{{ url('/my-orders') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="category">My Orders</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('/wishlist') ? 'active' : '' }}">
            <a href="{{ url('/wishlist') }}" class="menu-link">
         <i class="menu-icon tf-icons bx bx-heart"></i>
                <div data-i18n="category">My Wishlist</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('/cart') ? 'active' : '' }}">
            <a href="{{ url('/cart') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                 <div data-i18n="category">Cart Items</div>
            </a>
        </li>
       
    </ul>
</aside>
<!-- / Menu -->


            <div class="layout-page">
<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src=" {{ asset('/assets/dashboard/img/user-dummy.png') }}"
                            alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('/assets/dashboard/img/user-dummy.png') }}"
                                            alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                 <div class="flex-grow-1">
                                            <span class="fw-medium d-block">
                                                {{ Auth::user()->name }}
                                                </span>
                                        </div>
                            </div>
                        </a>
                    </li>
                     <li><hr class="dropdown-divider"></li>
                            <li>
        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                  
                </ul>
            </li>





            <!--/ User -->
        </ul>
    </div>
</nav>

<!-- / Navbar -->

  <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        
                 <div class="container">
    <h1>User Profile</h1>
    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <!-- Add more user details as needed -->
</div>

<!-- Footer -->

<!-- / Footer -->

 </div>
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
<!-- / Layout wrapper -->
<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('assets/dashboard/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendor/js/menu.js') }}"></script>
<!-- endbuild -->
<!-- Vendors JS -->
<script src="{{ asset('assets/dashboard/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendor/libs/select2/select2.js') }}"></script>
<!-- Main JS -->
<script src="{{ asset('assets/dashboard/js/main.js') }}"></script>
<!-- Page JS -->
<script src="{{ asset('assets/dashboard/js/dashboards-analytics.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
<!-- Api JS -->
<script src="{{ asset('assets/dashboard/js/api.js') }}"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.js"></script>
<script src="../../assets/vendor/libs/fullcalendar/fullcalendar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{asset('assets/dashboard/js/app-calendar-events.js')}}"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


</body>

</html>
                        