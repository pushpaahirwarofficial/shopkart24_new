@extends('frontend.layouts.main')

@section('main-container')

<style> 


body{
        font-family: sans-serif!important;
}
--typeHeaderFallback: {
     font-family: sans-serif!important;
}
.card-text {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 4.5em; /* (line-height) * (number of lines you want to show) */
        }
        
        .image-container {
            position: relative;
        }
        .add-to-cart-btn {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: none;
        }
        .image-container:hover .add-to-cart-btn {
                  display: block;
                    background: black;
                    color: white;
                    padding-right: 20px;
                    padding-left: 20px;
                    padding-top: 6px;
                    padding-bottom: 6px;
                    border-radius: 11px;
                    width: 183px;
                }
        .image-container img {
            display: block;
            width: 100%;
            height: auto;
        }
       </style>
       
       <style>
    .wp_icon{
        position:fixed;
        bottom:35px;
        right:0px;
        z-index:100;
    }
    
    .custom-button:hover {
    background: black!important;
    color: white!important;
}
  
    
    @media only screen and (min-width: 769px) {
    .index-section {
        margin: 0px 0!important;
    }
}

.slick-initialized .slick-slide {
    padding : 0px;
    margin : 0px!important;
}
</style>
  <style>
  .block-title h2{
    text-transform: uppercase!important;
    font-size: .3125in;
    color: #000;
    line-height: 1.2;
    font-weight: 500;
    text-align: center;
}
.new_icon{
    margin-right: 1.25pc;
}

.intro-item{
    font-size: 10.5pt;
        margin-bottom: 45px;
        align-items: center;
        display: flex;
}

.autoplay img{
    border-radius: 50% 50% 50% 50%;
    width:173px!important;
    height:173px!important;
}

@media (max-width: 768px) {
    .autoplay img {
        width: 100px !important;
        height: 100px !important;
    }
}

#site-footer ul {
     list-style: disc; 
}

.item-title a{
    color:black;
    /*margin-right: 50px;*/
}




.item-title {
margin-top: -15px;
font-weight: 400;
text-transform: uppercase;
font-size: .145833333in;
letter-spacing: 2px;
text-align:center;

}
.testimonial-excerpt {
    /*font-size: 1rem;*/
    color: grey;
}
.testimonial-title {


    font-size: 20px !important;
}
#site-footer{
    margin-top:20px!important;
     padding-bottom:10px!important;
}
.item{
    text-align:center;
}
.slick-initialized .slick-slide{
    background-color:white;
    padding:20px;
    margin:20px;
}

.item-product-cat-content{

}
.testimonial-title{
text-align: center;
color: #000;
line-height: 1.2;
font-weight: 500;
font-size: 24px;

}
.testimonial-customer-name{
    font-size: 17px;
    color:black;
}

.thumbnail {
    display: flex;
    justify-content: center;
}

.thumbnail img{
        border-radius: 50px 50px 50px;
}

.testimonial-excerpt{
    font-size: 1rem;

}
.star-4{
    color: #fcad02;
}



@media (max-width: 767px) {
    .intro-title {
        font-size: 26px!important; /* Font size for mobile */
    }
}

@media (min-width: 768px) {
    .section-container.large {
        padding-left: 15px!important;
        padding-right: 15px!important;
    }
}

@media (max-width: 767px) {
    .section-container.large {
        padding-left: 0!important;
        padding-right: 0!important;
    }
}

/*new*/
@media (max-width: 767px) {
    .pro {
        padding-right: 0 !important;
    }
}

@media (min-width: 768px) {
    .pro {
        padding-right: 12px !important;
    }
}


/* Media query for screens smaller than 768px (typical tablets and phones) */
@media (max-width: 767px) {
    .card-body {
        text-align: center; /* Center align the content */
    }
    .card-body .btn {
        display: block; /* Ensure the button takes full width */
        margin: 0 auto; /* Center the button horizontally */
    }
}

.truncate-text {
    display: inline-block;      /* Makes the element behave like an inline element with block properties */
    max-width: 100%;            /* Sets the maximum width of the element */
    overflow: hidden;           /* Ensures that content that overflows the element’s box is hidden */
    text-overflow: ellipsis;    /* Adds an ellipsis (...) to indicate that text has overflowed */
    white-space: nowrap;        /* Prevents text from wrapping to a new line */
    font-size: 14px;            /* Sets the font size to 14px */
}
.truncate-description {
    display: -webkit-box;        /* Enables the flexbox layout */
    -webkit-box-orient: vertical; /* Sets the orientation to vertical */
    -webkit-line-clamp: 2;       /* Limits the block container to 2 lines */
    overflow: hidden;            /* Ensures that content that overflows the element’s box is hidden */
    text-overflow: ellipsis;     /* Adds an ellipsis (...) to indicate that text has overflowed */
    line-height: 1.5;            /* Adjusts the line height (change if needed) */
    max-height: 3em;             /* Limits the maximum height to 2 lines (adjust based on line height) */
}

.parent {
    display: grid;
    place-items: center;
}

/* Default styles for larger screens (desktop, tablets, etc.) */
.coupon-info1 p {
    color: #ec688d !important;
    margin-top: -5px !important;
    font-size: 16px !important; /* Set the base font size for larger screens */
    text-align:center;
}


.item-image {
    display: flex;
    justify-content: center; /* Centers the image horizontally */
    align-items: center; /* Centers the image vertically if needed */
    height: 258px; /* Optional: set a consistent height */
}

.item-image img {
    max-width: 100%; /* Ensure the image scales properly */
}


/* Adjustments for medium screens (e.g., tablets) */
@media (max-width: 768px) {
    .product-cat-content-info {
        margin-top: -15px; /* Reduce margin for tablets */
    }
}

/* Adjustments for small screens (e.g., smartphones) */
@media (max-width: 767px) and (min-width: 380px) {
    .product-cat-content-info {
        margin-top: -50px; /* Further reduce margin for this specific range */
    }
}


</style>

  
    </div>
    <main class="main-content" id="MainContent">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <!-- BEGIN content_for_index -->

<section class="section" style="margin-bottom: 2px !important; background: white;">
    <div class="section-container">
         <!--Block Product Categories -->
        <div class="block block-product-cats slider round-border">
            <div class="block-widget-wrap">
                <div class="block-title">
                    <h2 style="padding-top: 67px; padding-bottom: 20px;">Top Categories</h2>
                </div>
                <div class="block-content" style="padding-bottom: 24px; margin-left: 47px;">
                    <div class="autoplay">
                        
                        @php $AnkletsCoupon = DB::table('coupons')->where('product_code', 10)->first() ?? '';  @endphp
                        <div class="parent">
                               <a href="{{ route('category.show', 10) }}" tabindex="0">
                                    <div class="item-image animation-horizontal">
                                        <img width="258" height="258" src="/assets/img/ancklet_new.jpg" alt="Anklets"/>
                                    </div>
                                </a>            
                                <div class="product-cat-content-info">
                                    <h2 class="item-title">
                                        <a href="{{ route('category.show', 10) }}" tabindex="0"><b>Anklets</b></a>
                                    </h2>
                                </div>
                                @if($AnkletsCoupon)
                                    @php
                                        $currentDate = new DateTime();
                                        $givenDateInstance = new DateTime($AnkletsCoupon->expires_at);
                                    @endphp
                                
                                    @if($givenDateInstance > $currentDate)
                                        <div class="coupon-info1">
                                            <!--<p><b>Coupon:</b> {{ $AnkletsCoupon->code }}</p>-->
                                        </div>
                                    @endif
                                @endif
                        </div>
                        
                        @php $EarringsCoupon = DB::table('coupons')->where('product_code', 2)->first() ?? '';  @endphp

                        <div class="parent">
                            <a href="{{ route('category.show', 2) }}" tabindex="0">
                                <div class="item-image animation-horizontal">
                                    <img width="258" height="258" src="https://caketheme.com/html/mojuri/media/product/cat-3.jpg" alt="Earrings"/>
                                </div>
                            </a>            
                            <div class="product-cat-content-info">
                                <h2 class="item-title">
                                    <a href="{{ route('category.show', 2) }}" tabindex="0"><b>Earrings</b></a>
                                </h2>
                                @if($EarringsCoupon)
                                    @php
                                        $currentDate1 = new DateTime();
                                        $givenDateInstance1 = new DateTime($EarringsCoupon->expires_at);
                                    @endphp
                                
                                    @if($givenDateInstance1 > $currentDate1)
                                        <div class="coupon-info1">
                                            <!--<p><b>Coupon:</b> {{ $EarringsCoupon->code }}</p>-->
                                        </div>
                                    @endif
                                @endif
                            </div>

                        </div>
                        
                        @php $NecklacesCoupon = DB::table('coupons')->where('product_code', 8)->first() ?? '';  @endphp

                        <div class="parent">
                            <a href="{{ route('category.show', 8) }}" tabindex="0">
                                <div class="item-image animation-horizontal">
                                    <img width="258" height="258" src="https://caketheme.com/html/mojuri/media/product/cat-4.jpg" alt="Necklaces"/>
                                </div>
                            </a>            
                            <div class="product-cat-content-info">
                                <h2 class="item-title">
                                    <a href="{{ route('category.show', 8) }}" tabindex="0"><b>Necklaces</b></a>
                                </h2>
                            </div>
                                @if($NecklacesCoupon)
                                    @php
                                        $currentDate2 = new DateTime();
                                        $givenDateInstance2 = new DateTime($NecklacesCoupon->expires_at);
                                    @endphp
                                
                                    @if($givenDateInstance2 > $currentDate2)
                                        <div class="coupon-info1">
                                            <!--<p><b>Coupon:</b> {{ $NecklacesCoupon->code }}</p>-->
                                        </div>
                                    @endif
                                @endif
                        </div>
                        
                        @php $RingsCoupon = DB::table('coupons')->where('product_code', 11)->first() ?? '';  @endphp
                        
                        <div class="parent">
                            <a href="{{ route('category.show', 11) }}" tabindex="0">
                                <div class="item-image animation-horizontal">
                                    <img width="258" height="258" src="https://caketheme.com/html/mojuri/media/product/cat-5.jpg" alt="Rings"/>
                                </div>
                            </a>            
                            <div class="product-cat-content-info">
                                <h2 class="item-title">
                                    <a href="{{ route('category.show', 11) }}" tabindex="0"><b>Rings</b></a>
                                </h2>
                            </div>
                                @if($RingsCoupon)
                                    @php
                                        $currentDate3 = new DateTime();
                                        $givenDateInstance3 = new DateTime($RingsCoupon->expires_at);
                                    @endphp
                                
                                    @if($givenDateInstance3 > $currentDate3)
                                        <div class="coupon-info1">
                                            <!--<p><b>Coupon:</b> {{ $RingsCoupon->code }}</p>-->
                                        </div>
                                    @endif
                                @endif
                        </div>
                        
                        <div class="parent">
                            <a href="" tabindex="0">
                                <div class="item-image animation-horizontal">
                                    <img width="258" height="258" src="/assets/img/hair.png" alt="Bracelets"/>
                                </div>
                            </a>            
                            <div class="product-cat-content-info">
                                <h2 class="item-title">
                                    <a href="" tabindex="0"><b> Accessories</b></a>
                                </h2>
                            </div>
                        </div>
                        
                        @php $BraceletsCoupon = DB::table('coupons')->where('product_code', 9)->first() ?? '';  @endphp
                        
                        <div class="parent">
                            <a href="{{ route('category.show', 9) }}" tabindex="0">
                                <div class="item-image animation-horizontal">
                                    <img width="258" height="258" src="https://caketheme.com/html/mojuri/media/product/cat-1.jpg" alt="Bracelets"/>
                                </div>
                            </a>            
                            <div class="product-cat-content-info">
                                <h2 class="item-title">
                                    <a href="{{ route('category.show', 9) }}" tabindex="0"><b>Bracelets</b></a>
                                </h2>
                            </div>
                                @if($BraceletsCoupon)
                                    @php
                                        $currentDate4 = new DateTime();
                                        $givenDateInstance4 = new DateTime($BraceletsCoupon->expires_at);
                                    @endphp
                                
                                    @if($givenDateInstance4 > $currentDate4)
                                        <div class="coupon-info1">
                                            <!--<p><b>Coupon:</b> {{ $BraceletsCoupon->code }}</p>-->
                                        </div>
                                    @endif
                                @endif
                        </div>
                        
                    </div>                              
                </div>
            </div>
        </div>
    </div>
</section>

        <!--<section>-->
            <!--<div class="row">-->
                <!--<img src="/assets/dashboard/img/banner_new.png">-->
        <!--        <img src="/assets/dashboard/img/bannneeerr (2).webp">-->
                                <!--<img src="images/shopkart24 1.webp">-->

            <!--</div>-->
        <!--</section>-->
        
  <section class="single-item">
    <div><a href="{{ url('/jewelry') }}"><img src="/assets/dashboard/img/bannneeerr (2).webp" alt="Image 1"></a></div>
    <div><a href="{{ url('/jewelry') }}"><img src="/assets/dashboard/img/banner/banner01--1200x450.gif" alt="Image 1" style="width: 100%;"></a> </div>
   
   
  </section>
         <section class="mt-2">
            <!--<div class="row">-->
                <!--<img src="/assets/dashboard/img/banner_new.png">-->
                <a href="{{ url('/jewelry') }}"><img src="/assets/dashboard/img/banner/banner02--1200x450.gif" style="width: 100%;"></a>
                
                                <!--<img src="images/shopkart24 1.webp">-->

            <!--</div>-->
        </section>
        
         <section class="mt-2">
            <!--<div class="row">-->
                <!--<img src="/assets/dashboard/img/banner_new.png">-->
                <a href="{{ url('/jewelry') }}"><img src="/assets/dashboard/img/banner/banner06--1200x450.gif" style="width: 100%;"></a>
                                <!--<img src="images/shopkart24 1.webp">-->

            <!--</div>-->
        </section>
        
        
    <div id="shopify-section-1525295772132" class="shopify-section index-section" style="background:#fffdf5; ">
    <div id="CollectionSection-1525295772132" data-section-id="1525295772132" data-section-type="collection-template" style="">
        <div class="page-width">
            <div class="section-header" style="margin-bottom:20px;">
                <h2 class="section-header__title text-center">RECENTLY ADDED</h2>
            </div>
        </div>
    </div>
    
    <div class="row" style="margin-right: 24px; margin-left: 14px;">
        @foreach($products as $product)
   <div class="col-12 col-md-3 pro mt-3" style="padding-right:0px!important">
    <div class="card" >
        <div class="image-container">
            <img src="{{ asset('image/' . $product->firstImage) }}" class="card-img-top img-fluid" alt="{{ $product->productName }}" style="height:275px; ">
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->productId }}">
                <button type="submit" class="add-to-cart-btn">
                    <span class="fa fa-shopping-cart px-1"></span>Add To Cart
                </button>
            </form>
        </div>
        <div class="card-body">
            <h6 class="card-title" style="font-size: 0.5rem; margin-bottom: 2px">
                <a href="{{ route('product.view', $product->productId) }}" class="truncate-text" style="font-size: 14px; color:black;">{{ $product->productName }}</a>
            </h6>
           
            <p class="card-text" style="margin-bottom:2px; height:38px; color:black; margin-top: 15px;"><b style="font-size:20px;">₹{{ $product->productPrice }}</b></p>
           <div class="text-center">
                <a href="{{ route('product.view', $product->productId) }}" class="btn" > <button style="background: #ec688d; border: 2px solid #ec688d; color: white; width: 106px; font-size:12px; padding-bottom: 8px; padding-top: 8px;">SHOP NOW</button></a>

           </div>
        </div>
    </div>
</div>

        @endforeach
    </div>

    <div class="d-flex justify-content-center">
    <a href="{{ url('/jewelry') }}" class="btn mt-2" style="background:#736868; color:white; margin-top:40px; margin-bottom: 20px; text-transform: none!important;">
        View More
    </a>
</div>

</div>        
    
<section class="background-img bg-img-1" style="background:white;">
    <div class="block block-intro">
        <div class="row">
            <div class="col-md-6 section-column">
                <div class="intro-wrap"style="padding-top:38px!important;">
                    <h2 style="color: #ec688d;"><b>Why Choose Us?</b></h2>
                    <h3 class="title"></h3>
                    
                     <div class="text mb-4" style="font-size: 15px!important;"><b>Crafted with Care, Sourced with Integrity
Improve Your Style Ethically with Shopkart24's Handcrafted Jewelry </b></div>
                    <div class="intro-item">
                        <div class="icon new_icon">
                            <span class="wrap animation-horizontal">
                               <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" height="100%" viewBox="0 0 512.001 512.001" width="100%">
                                    <g>
                                        <g>
                                            <path d="m479.371 131.029c-3.099 0-6.154-1.436-8.11-4.139-3.236-4.475-2.233-10.727 2.241-13.963l22.638-16.376c4.475-3.239 10.727-2.233 13.964 2.241 3.236 4.475 2.233 10.727-2.241 13.963l-22.638 16.376c-1.772 1.281-3.823 1.898-5.854 1.898z"></path>
                                        </g>
                                        <g>
                                            <path d="m32.63 131.029c-2.032 0-4.082-.617-5.854-1.898l-22.637-16.376c-4.475-3.237-5.478-9.488-2.241-13.963 3.238-4.474 9.49-5.478 13.964-2.241l22.638 16.375c4.475 3.237 5.478 9.488 2.241 13.963-1.956 2.703-5.012 4.14-8.111 4.14z"></path>
                                        </g>
                                        <g>
                                            <path d="m256.001 49.025c-5.522 0-10-4.477-10-10v-23.867c0-5.523 4.478-10 10-10s10 4.477 10 10v23.866c0 5.523-4.478 10.001-10 10.001z"></path>
                                        </g>
                                        <path d="m492.647 215.277-77.499-133.949c-1.787-3.09-5.086-4.992-8.655-4.992h-300.986c-3.569 0-6.868 1.902-8.655 4.992l-77.498 133.949c-2.092 3.614-1.717 8.147.939 11.369l227.991 276.558c1.899 2.305 4.729 3.639 7.716 3.639s5.816-1.334 7.716-3.639l85.631-103.871 1.009.399 22.572 57.368c1.505 3.824 5.196 6.338 9.306 6.338s7.801-2.514 9.306-6.338l22.572-57.368 57.228-22.623c3.817-1.509 6.324-5.196 6.324-9.3s-2.507-7.791-6.323-9.3l-57.229-22.623-4.026-10.231 81.621-99.009c2.657-3.222 3.032-7.754.94-11.369zm-25.994-4.992h-113.904l53.737-103.991zm-210.652 248.864-67.465-228.863h22.259c5.522 0 10-4.477 10-10s-4.478-10-10-10h-17.303l62.508-102.427 62.508 102.426h-17.301c-5.522 0-10 4.477-10 10s4.478 10 10 10h22.26zm79.601-259.246-63.204-103.567h116.722zm-167.918 30.382 65.943 223.697-184.414-223.697zm8.713-30.382-53.517-103.567h116.722zm-70.883-93.609 53.736 103.991h-113.902zm172.86 347.689 21.836-74.074 29.588 11.696zm162.089-86.174-37.741 14.919c-2.577 1.019-4.615 3.06-5.63 5.638l-14.857 37.76-14.857-37.76c-1.015-2.578-3.053-4.62-5.63-5.638l-37.741-14.919 37.742-14.92c2.576-1.019 4.614-3.06 5.629-5.638l14.857-37.76 14.857 37.76c1.015 2.578 3.053 4.62 5.629 5.638zm-48.923-89.291c-1.505-3.824-5.196-6.338-9.306-6.338s-7.801 2.514-9.306 6.338l-22.572 57.368-42.071 16.631 36.032-122.232h118.47l-61.075 74.087z"></path>
                                        <path d="m256.18 230.291c-4.12 0-7.897-2.638-9.35-6.483-1.491-3.948-.269-8.58 3.006-11.255 3.235-2.643 7.897-2.987 11.481-.842 3.583 2.144 5.496 6.426 4.674 10.529-.924 4.61-5.103 8.051-9.811 8.051z"></path>
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <div class="content">
                            <h3 class="title"><b>FAIR PRICING</b></h3>
                            <div class="text" style="font-size: 15px!important;">We at Shopkart24 support reasonable prices which benefits both vendors and customers all over India. We promise to give you the greatest value on finely designed jewelry with our open pricing policy. </div>
                        </div>
                    </div>
                    <div class="intro-item">
                        <div class="icon new_icon">
                            <span class="wrap animation-horizontal">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                                    <path d="M32,1C15.5,1,2,14.5,2,31c0,6.5,2.1,12.5,5.7,17.3L32,63c0,0,0,0,0,0c0,0,0,0,0,0l24.3-14.8C59.9,43.5,62,37.5,62,31C62,14.5,48.5,1,32,1z M32,43c-6.6,0-12-5.4-12-12s5.4-12,12-12s12,5.4,12,12S38.6,43,32,43z"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="content">
                            <h3 class="title"><b>HIGH QUALITY</b></h3>
                            <div class="text" style="font-size: 15px!important;">At Shopkart24, quality is the cornerstone of everything we provide. To guarantee its longevity and style, each piece of jewelry is carefully crafted using materials that are picked up ethically.</div>
                        </div>
                    </div>
<div class="text-center mt-3">
        <a href="/about" class="btn custom-button" style="background:#ec688d!important; color:white;     padding: 13px;
    font-size: 13px; text-transform: none!important;">Learn More</a>
    </div>            
    </div>
            </div>
            <div class="col-md-6 section-column">
                <a class="hover-opacity" href="#">
                    <!--<img class="img-fluid" src="https://caketheme.com/html/mojuri/media/banner/intro-1.jpg" alt="Product Image">-->
                    <img class="img-fluid" src="images/shopkart24 2.webp" alt="Product Image">
                </a>
            </div>
        </div>
    </div>
</section>



<section style="background: #fffdf5; margin-bottom: 20px;">
    <div class="section-container">
         <!--Block Testimonial -->
        <div class="block block-testimonial layout-2">
            <div class="block-widget-wrap">
                <div class="block-title mt-4 mb-4">
                    <h2 class="pt-5">What Our Customers Say</h2>
                </div>
                <div class="multiple-items ggg">
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="testimonial-icon">
                                <div class="rating">
                                    <div class="star-4">★★★★★</div>
                                </div>
                            </div>
                            <h2 class="testimonial-title" style="font-size: 16px;">“Fabulous Grounds”</h2>
                            <div class="testimonial-excerpt" style="font-size: 14px;">
                               "Love my new Pearl Hoop Korean Earring from Shopkart24! The parcel arrived quickly and look even better than my expectation. Great quality and quick customer service! Thank you shopkart24"
                            </div>
                        </div>
                        <div class="testimonial-image image-position-top">
                            <div class="thumbnail mt-3">
                                <img width="80" height="80" src="/assets/dashboard/img/girl.jfif" alt="" style="height: 80px !important; width:80px!important;">
                            </div>
                            <div class="testimonial-info">
                                <h2 class="testimonial-customer-name" style="padding-bottom: 27px; padding-top: 10px; font-size: 14px;">Radhika</h2>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="testimonial-icon">
                                <div class="rating">
                                    <div class="star-4">★★★★★</div>
                                </div>
                            </div>
                            <h2 class="testimonial-title" style="font-size: 16px;">“Great vineyard tour and tasting!”</h2>
                            <div class="testimonial-excerpt" style="font-size: 14px;">
                               "The bracelet I ordered is stunning! It's beautifully hand crafted and exactly as described. Very pleased with my purchase from Shopkart24."
                            </div>
                        </div>
                        <div class="testimonial-image image-position-top">
                            <div class="thumbnail mt-3">
                                <img width="80" height="80" src="/assets/dashboard/img/girl_13.jfif" alt="" style="height: 80px !important; width:80px!important;">
                            </div>
                            <div class="testimonial-info">
                                <h2 class="testimonial-customer-name" style="padding-bottom: 27px; padding-top: 10px; font-size: 14px;">Reshma Tyagi</h2>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="testimonial-icon">
                                <div class="rating">
                                    <div class="star-4">★★★★★</div>
                                </div>
                            </div>
                            <h2 class="testimonial-title" style="font-size: 16px;">“Stunning Design”</h2>
                            <div class="testimonial-excerpt" style="font-size: 14px;">
                               "I bought a Multicolor Kundan Choker Set for my mom's birthday and she adores it! The packaging was lovely and the set itself is just wow. "
                            </div>
                        </div>
                        <div class="testimonial-image image-position-top">
                            <div class="thumbnail mt-3">
                                <img width="80" height="80" src="/assets/dashboard/img/girl_12.jfif" alt="" style="height: 80px !important; width:80px!important;">
                            </div>
                            <div class="testimonial-info">
                                <h2 class="testimonial-customer-name" style="padding-bottom: 27px; padding-top: 10px; font-size: 14px;">Kiran Gaur</h2>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="testimonial-icon">
                                <div class="rating">
                                    <div class="star-4">★★★★★</div>
                                </div>
                            </div>
                            <h2 class="testimonial-title" style="font-size: 16px;">“Amazing piece of history”</h2>
                            <div class="testimonial-excerpt" style="font-size: 14px;">
                                "Received my bracelet from Shopkart24 and I absolutely love it! It fits perfectly and the design is exactly what I was looking for. Will shop here again for sure."
                            </div>
                        </div>
                        <div class="testimonial-image image-position-top">
                            <div class="thumbnail mt-3">
                                <img width="80" height="80" src="/assets/dashboard/img/girl_15.jfif" alt=""style="height: 80px !important; width:80px!important;">
                            </div>
                            <div class="testimonial-info">
                                <h2 class="testimonial-customer-name" style="padding-bottom: 27px; padding-top: 10px; font-size: 14px;">Divya Sharma</h2>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="testimonial-icon">
                                <div class="rating">
                                    <div class="star-4">★★★★★</div>
                                </div>
                            </div>
                            <h2 class="testimonial-title" style="font-size: 16px;">“Fabulous Grounds”</h2>
                            <div class="testimonial-excerpt" style="font-size: 14px;">
                                "I Ordered a Anitque Marble Design Choker Set and it arrived sooner than expected. Packaging was secure, and the set was as it is shown in the picture. Impressed with the efficiency of Shopkart24's delivery."
                            </div>
                        </div>
                        <div class="testimonial-image image-position-top">
                            <div class="thumbnail mt-3">
                                <img width="80" height="80" src="/assets/dashboard/img/girl_16.jfif" alt="" style="height: 80px !important; width:80px!important;">
                            </div>
                            <div class="testimonial-info">
                                <h2 class="testimonial-customer-name" style="padding-bottom: 27px; padding-top: 10px; font-size: 14px;">Ankita Agarwal</h2>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</section>
<section class="" style="padding-top: 40px; padding-bottom: 40px; background:white;">
    <div class="section-container large">
        <h1 class="text-center">Top Collections</h1>
         <!--Block Banners (Layout 1) -->
        <div class="block block-banners layout-1 banners-effect">
            <div class="block-widget-wrap small-space">
                <div class="row">
                    <div class="col-md-4">
                        <div class="block-widget-banner">
                            <div class="bg-banner">
                                <div class="banner-wrapper banners">
                                    <div class="banner-image">
                                        <a href="{{ route('category.show', 2) }}">
                                            <img src="/assets/dashboard/img/1 .webp" alt="Banner Image" style="width:340!important; height:246!important;">
                                        </a>
                                    </div>
                                    <div class="banner-wrapper-infor">
                                        <div class="info">
                                            <!--<div class="content">-->
                                            <!--    <h3 class="title-banner">New Arrivals</h3>-->
                                            <!--    <a class="button" href="">Shop Now</a>						-->
                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="block-widget-banner">
                            <div class="bg-banner">
                                <div class="banner-wrapper banners">
                                    <div class="banner-image">
                                        <a href="{{ route('category.show', 11) }}">
                                            <!--<img src="/assets/dashboard/img/banner-1-2.jpg" alt="Banner Image">-->
                                            
                                            <img src="/assets/dashboard/img/2.webp" alt="Banner Image">
                                        </a>
                                    </div>
                                    <div class="banner-wrapper-infor text-center">
                                        <div class="info">
                                            <!--<div class="content">-->
                                            <!--    <h3 class="title-banner"></h3>-->
                                            <!--    <a class="button" href="">Shop Now</a>						-->
                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="block-widget-banner">
                            <div class="bg-banner">
                                <div class="banner-wrapper banners">
                                    <div class="banner-image">
                                        <a href="{{ route('category.show', 8) }}">
                                            <img src="/assets/dashboard/img/3 .webp" alt="Banner Image" style="width:100%;">
                                        </a>
                                    </div>
                                    <div class="banner-wrapper-infor">
                                        <div class="info">
                                            <!--<div class="content">-->
                                            <!--    <h3 class="title-banner">Clearance Sale</h3>-->
                                            <!--    <a class="button" href="">Shop Now</a>						-->
                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
         
        
<!--<section class="section " style="background:#f5f5f9; padding-top:50px; padding-bottom:50px;">-->
<!--								<div class="section-container">-->
									<!-- Block Image -->
<!--									<div class="block block-image slider">-->
<!--										<div class="block-widget-wrap">-->
<!--											<div class="block block-testimonial layout-2">-->
<!--										<div class="block-widget-wrap">-->
											
<!--										     <div class="multiple-brand">-->
							
<!--								<div class="item">-->
							
<!--									<div class="">-->
<!--										<img width="175" height="175" src="https://caketheme.com/html/mojuri/media/brand/2.jpg" alt="">							-->
<!--									</div>-->
<!--								 </div>	-->
<!--								<div class="item">-->
							
<!--									<div class="">-->
<!--										<img width="175" height="175" src="https://caketheme.com/html/mojuri/media/brand/3.jpg" alt="">							-->
<!--									</div>-->
<!--								 </div>	-->
<!--								<div class="item">-->
							
<!--									<div class="">-->
<!--										<img width="175" height="175" src="https://caketheme.com/html/mojuri/media/brand/4.jpg" alt="">							-->
<!--									</div>-->
<!--								 </div>	-->
<!--								<div class="item">-->
							
<!--									<div class="">-->
<!--										<img width="175" height="175" src="https://caketheme.com/html/mojuri/media/brand/5.jpg" alt="">							-->
<!--									</div>-->
<!--								 </div>	-->
                           
<!--								<div class="item">-->
							
<!--									<div class="">-->
<!--										<img width="175" height="175" src="https://caketheme.com/html/mojuri/media/brand/1.jpg" alt="">							-->
<!--									</div>-->
<!--								 </div>	-->
                           
								
														
															
       
<!--										</div>-->
<!--									</div>-->
<!--										</div>-->
<!--									</div>-->
<!--								</div>-->
<!--							</section>   -->
        
        <div id="shopify-section-1661622546ec4192af" class="shopify-section">
    
            <div id="insta-feed"></div>
          </div><!-- END content_for_index -->
        
        </main>
        <div id="shopify-section-footer-promotions" class="shopify-section index-section--footer">
        </div>
      
        
        <div>
    <a href="https://wa.me/919999950946" target="_blank">  
        <img src="/assets/dashboard/img/wp_icon.webp" class="wp_icon" style="width:120px;height:80px;" alt="whatsapp icon"/>
    </a>
</div>



    @endsection
