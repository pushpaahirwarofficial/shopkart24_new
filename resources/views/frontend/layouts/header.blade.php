<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopKart24</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/css/theme.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/css/searchtab.css') }}">
    <link rel="stylesheet" type="text/css" href="slick/slick.css">
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
    <link href="cdn/shop/t/40/assets/theme78b0.css?v=139269663027275441241714929435" rel="stylesheet" type="text/css" media="all">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/fonts/boxicons.css') }}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/css/core.css') }}" class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/css/theme-default.css') }}" class="template-customizer-theme-css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/demo.css') }}">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">

<!-- Include noUiSlider CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">


    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/vendor/css/pages/page-auth.css') }}">
    
    
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<!-- Include noUiSlider JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>


    <!-- Helpers -->
    <script src="{{ asset('assets/dashboard/vendor/js/helpers.js') }}"></script>
    
</head>
 <style>
    .input-group {
      position: relative;
      display: flex;
      align-items: center;
    }
@media only screen and (max-width: 768px) {
    .small--hide {
        display: block !important;
    }
}
@media only screen and (max-width: 768px) {
    .wish {
        display: none !important;
    }
}
    .input-group .form-control {
      padding-right: 2.5rem; /* Adjust based on the size of the icon */
    }

    .input-group .fa-search {
      position: absolute;
      right: 0.75rem; /* Adjust to align the icon inside the input */
      color: #aaa; /* Adjust icon color */
    }

    .input-group .btn {
      display: none; /* Hide the button if not needed */
    }
    
    
    /* Dropdown container */
.nav-item.dropdown {
    position: relative;
}

/* Hide dropdown menu by default */
.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #fff; /* Adjust as needed */
    border: 1px solid #ddd; /* Optional border */
    padding: 0;
    margin: 0;
    list-style: none;
    z-index: 1000; /* Ensure dropdown appears above other content */
}

/* Show dropdown menu on hover */
.nav-item:hover .dropdown-menu {
    display: block;
}

/* Dropdown item styling */
.dropdown-menu .dropdown-item {
    padding: 10px 20px; /* Adjust padding as needed */
    text-decoration: none;
    color: #333; /* Adjust text color */
    display: block;
}

/* Dropdown item hover effect */
.dropdown-menu .dropdown-item:hover {
    background-color: #f8f9fa; /* Adjust hover background color */
}
/* Container for scrolling effect */
.announcement-slider__slide {
    width: 100%; /* Full width of the container */
    overflow: hidden; /* Hide the overflowing text */
  
  
   
}

/* Scrolling text effect */
.marquee {
    display: inline-block;
    white-space: nowrap; /* Prevent text wrapping */
    animation: marquee 25s linear infinite; /* Adjust duration as needed */
}

/* Keyframes for the scrolling effect */
@keyframes marquee {
    0% {
        transform: translateX(100%); /* Start from right */
    }
    100% {
        transform: translateX(-100%); /* End at left */
    }
}



  </style>
<body class="no-js">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background:#fffdf5!important;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('frontend/img/Logo.png') }}" alt="ShopKart24" style="width:133px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item site-nav__item site-nav__expanded-item">
                        <a class="nav-link active site-nav__link site-nav__link--underline" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    <!--<li class="nav-item site-nav__item site-nav__expanded-item">-->
                    <!--    <a class="nav-link site-nav__link site-nav__link--underline" href="{{ ('/about') }}">About Us</a>-->
                    <!--</li>-->
                  <li class="nav-item site-nav__item site-nav__expanded-item dropdown">
                        <a class="nav-link site-nav__link site-nav__link--underline" href="#" id="jewelryDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Jewellery
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="jewelryDropdown">
                            <li><a class="dropdown-item" href="{{ route('category.show', 2) }}">Earrings</a></li>
                            <li><a class="dropdown-item" href="{{ route('category.show', 8) }}">Necklaces</a></li>
                            <li><a class="dropdown-item" href="{{ route('category.show', 9) }}">Bracelets</a></li>
                            <li><a class="dropdown-item" href="{{ route('category.show', 10) }}">Anklets</a></li>
                            <li><a class="dropdown-item" href="{{ route('category.show', 11) }}">Rings</a></li>
                        </ul>
                    </li>


                    <!--<li class="nav-item site-nav__item site-nav__expanded-item">-->
                    <!--    <a class="nav-link site-nav__link site-nav__link--underline" href="{{ url('/blog') }}">Blog</a>-->
                    <!--</li>-->
                    <li class="nav-item site-nav__item site-nav__expanded-item">
                        <a class="nav-link site-nav__link site-nav__link--underline" href="{{ url('/contact') }}">Contact Us</a>
                    </li>
                    <li class="nav-item site-nav__item site-nav__expanded-item">
                        <a class="nav-link site-nav__link site-nav__link--underline" href="{{ url('/sale-of-the-week') }}">Weekly Sale</a>
                    </li>
                </ul>
<!--    <form class="d-flex" id="search-form">-->
<!--    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search-input">-->
<!--    <button type="button" id="search-previous" style="display: none;">Up Arrow</button>-->
<!--    <button type="button" id="search-next" style="display: none;">Down Arrow</button>-->
<!--</form>-->
<!--<p id="search-count"></p>-->
<!--<div id="search-results"></div>-->

<form class="d-none d-lg-flex" id="search-form" action="{{ route('search') }}" method="GET">
    <!--@csrf-->
     <div class="input-group">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search-input" name="query">
    <i class="fas fa-search"></i>
  </div>
</form>


<!--<div id="search-results">-->
    <!-- Search results will be dynamically inserted here -->
<!--</div>-->

<!-- Container for displaying products -->
<div class="product-container">
    <!-- Products will be dynamically added here -->
</div>
                <div class="header-item header-item--icons">
                    <div class="site-nav">
                            <div class="site-nav__icons d-flex">
                                <form class="d-flex d-lg-none" id="search-form" action="{{ route('search') }}" method="GET">
                                    <!--@csrf-->
                                     <div class="input-group">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search-input" name="query">
                                    <i class="fas fa-search"></i>
                                  </div>
                                </form>
                             @if (Auth::check() && Auth::user()->password != 'temp password')
    <a class="site-nav__link site-nav__link--icon small--hide" href="{{ url('/profile') }}">
        <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-account" viewBox="0 0 64 64">
            <path d="M32 0C14.33 0 0 14.33 0 32s14.33 32 32 32 32-14.33 32-32S49.67 0 32 0zm0 6c7.18 0 13 5.82 13 13s-5.82 13-13 13-13-5.82-13-13S24.82 6 32 6zm0 52c-10.93 0-20.69-6.45-25.06-15.75 3.78-4.61 9.68-7.25 15.82-7.25 1.17 0 2.33.1 3.44.29 2.61.45 5.04 1.35 7.31 2.62 2.27-1.27 4.7-2.17 7.31-2.62 1.11-.19 2.27-.29 3.44-.29 6.14 0 12.04 2.64 15.82 7.25C52.69 51.55 42.93 58 32 58z"/>
        </svg>
        <span class="icon__fallback-text">Account</span>
    </a>
@elseif (Auth::check() && Auth::user()->password == 'temp password')
    <a class="site-nav__link site-nav__link--icon small--hide" href="{{ route('user.temp_logout') }}">
        <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-account" viewBox="0 0 64 64">
            <path d="M32 0C14.33 0 0 14.33 0 32s14.33 32 32 32 32-14.33 32-32S49.67 0 32 0zm0 6c7.18 0 13 5.82 13 13s-5.82 13-13 13-13-5.82-13-13S24.82 6 32 6zm0 52c-10.93 0-20.69-6.45-25.06-15.75 3.78-4.61 9.68-7.25 15.82-7.25 1.17 0 2.33.1 3.44.29 2.61.45 5.04 1.35 7.31 2.62 2.27-1.27 4.7-2.17 7.31-2.62 1.11-.19 2.27-.29 3.44-.29 6.14 0 12.04 2.64 15.82 7.25C52.69 51.55 42.93 58 32 58z"/>
        </svg>
        <span class="icon__fallback-text">Account</span>
    </a>
@else
    <a class="site-nav__link site-nav__link--icon small--hide" href="{{ route('user.signinPhone') }}">
        <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-user" viewBox="0 0 64 64">
            <path d="M35 39.84v-2.53c3.3-1.91 6-6.66 6-11.41 0-7.63 0-13.82-9-13.82s-9 6.19-9 13.82c0 4.75 2.7 9.51 6 11.41v2.53c-10.18.85-18 6-18 12.16h42c0-6.19-7.82-11.31-18-12.16z" />
        </svg>
        <span class="icon__fallback-text">Log in</span>
    </a>
@endif

<a class="site-nav__link site-nav__link--icon small--hide wish" href="{{ url('/wishlist') }}">
   <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-heart" viewBox="0 0 64 64">
            <path d="M32 58s-7.2-4.1-12-8.5C14.5 44.6 10 40.2 10 34.5 10 28 15 23 21.5 23c3.4 0 6.8 1.8 8.5 4.7C32.7 24.8 36.1 23 39.5 23 46 23 51 28 51 34.5c0 5.7-4.5 10.1-10 15C39.2 53.9 32 58 32 58z"/>
        </svg>
        <span class="icon__fallback-text">Wishlist</span>
</a>
                                <a href="{{ url('/cart') }}" class="site-nav__link site-nav__link--icon js-drawer-open-cart" aria-controls="CartDrawer" data-icon="cart">
                                    <span class="cart-link">
                                        <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-cart" viewBox="0 0 64 64">
                                            <path fill="none" d="M14 17.44h46.79l-7.94 25.61H20.96l-9.65-35.1H3" />
                                            <circle cx="27" cy="53" r="2" />
                                            <circle cx="47" cy="53" r="2" />
                                        </svg>
                                        <span class="icon__fallback-text">Cart</span>
                                        <span id="CartBubble" class="cart-link__bubble"></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                </div>
   
           </div>
       </div>
</nav>

                    <div class="announcement-bar">
                        <div class="page-width">
                            <div class="slideshow-wrapper">
                                <button type="button" class="visually-hidden slideshow__pause" data-id="header"
                                    aria-live="polite">
                                    <span class="slideshow__pause-stop">
                                        <svg aria-hidden="true" focusable="false" role="presentation"
                                            class="icon icon-pause" viewBox="0 0 10 13">
                                            <g fill="#000" fill-rule="evenodd">
                                                <path d="M0 0h3v13H0zM7 0h3v13H7z" />
                                            </g>
                                        </svg>
                                        <span class="icon__fallback-text">Pause slideshow</span>
                                    </span>
                                    <span class="slideshow__pause-play">
                                        <svg aria-hidden="true" focusable="false" role="presentation"
                                            class="icon icon-play" viewBox="18.24 17.35 24.52 28.3">
                                            <path fill="#323232" d="M22.1 19.151v25.5l20.4-13.489-20.4-12.011z" />
                                        </svg>
                                        <span class="icon__fallback-text">Play slideshow</span>
                                    </span>
                                </button>

@php
$coupons = DB::table('coupons')->where('expires_at', '>=', now())->get();
@endphp
                                <div id="AnnouncementSlider" class="announcement-slider" data-compact="true"
                                    data-block-count="3">
                                    <div id="AnnouncementSlide-1524770292306" class="announcement-slider__slide" data-index="0">
                                        <span class="announcement-text">
                                            <div style="color:white!important;" class="marquee">
                                                <!--<span>Shine Brighter, Spend Smarter: Exclusive Discounts on Stunning Jewelry!</span>-->
                                                @foreach ($coupons as $coupon)
                                                    @php
                                                        $category = DB::table('category')->where('categoryId', $coupon->product_code)->first();
                                                        $suffix = $coupon->discount_type == 'percent' ? '%' : '.00';
                                                    @endphp
                                                <span>Buy {{ $category->categoryName ?? '' }}, get extra {{ $coupon->discount_amount ?? '' }}{{ $suffix }} off.Use code: {{ $coupon->code ?? '' }}</span> | 
                                                @endforeach
                                            </div>
                                        </span>
                                    </div>

                                    <div id="AnnouncementSlide-1524770296206" class="announcement-slider__slide"
                                        data-index="1"><span class="announcement-text">Free Shipping for prepaid
                                            orders</span></div>
                                    <div id="AnnouncementSlide-bbd40ada-6bda-4119-96e1-5be93ee73fba"
                                        class="announcement-slider__slide" data-index="2"><span
                                            class="announcement-text">Exclusive Sale Live Now</span></div>
                                </div>
                            </div>
                        </div>
                    </div>




<style>
    .highlight {
        background-color: yellow;
    }
</style>
<style>
    .highlight {
        background-color: yellow;
        font-weight: bold;
    }
    .result-item {
        border: 1px solid #ddd;
        padding: 10px;
        margin: 10px 0;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




