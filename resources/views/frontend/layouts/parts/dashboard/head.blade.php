<!--================= Meta tag =================-->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

<title>@yield('title', 'Advocate Admin') | @yield('title_type', '') Dashboard</title>

<meta name="description" content="" />

    @stack('styles')


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

