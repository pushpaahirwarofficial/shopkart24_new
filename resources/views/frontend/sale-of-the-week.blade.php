@extends('frontend.layouts.main') <!-- Adjust the layout as per your application -->

@section('main-container')
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <style>
 
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
                padding-left: 46px;
                padding-top: 9px;
                padding-bottom: 9px;
                border-radius: 11px;
                width: 200px;
                }
                
               
.wishlist-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    display: none;
    background: black;
    color: white;
    padding: 9px 10px;
    border-radius: 11px;
} 
     .image-container:hover .wishlist-btn {
    display: block;
}         
.wishlist-btn.clicked {
    background: white;
    color: red;
}
        .image-container img {
            display: block;
            width: 100%;
            height: auto;
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

@media (max-width: 991px) {
    .site-navigation ul {
        display: block;
        text-align: center; /* Center align the menu items */
        padding: 0;
    }
    .site-navigation li {
        display: inline-block; /* Display the menu items inline */
        margin-left: 15px; /* Add some space between menu items */
    }
}

        
    </style>
    
    <style>
    /* Default styling for the site menu (desktop view) */
    .site-menu li a {
        font-size: 16px; /* Default font size for desktop */
    }

    /* Media query for mobile devices */
    @media (max-width: 767px) {
        .site-menu {
            display: flex;
            flex-wrap: nowrap;
            justify-content: space-between; /* Adjust the spacing */
        }
        .site-menu li {
            margin-right: 5px; /* Adjust spacing between items */
        }
        .site-menu li a {
            font-size: 12px; /* Smaller font size for mobile */
        }
    }
     @media (max-width: 767px) {
        .site-navbar .site-navigation .site-menu > li > a > span {
            padding: 0; /* Remove padding for mobile view */
            margin-left:0px;
        }
        .site-navbar .site-navigation .site-menu > li  {
            margin-left:5px;
        }
    }
    
    @media (max-width: 991.98px) {
    .site-menu.js-clone-nav {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch; /* For smooth scrolling on iOS */
        -ms-overflow-style: -ms-autohiding-scrollbar; /* For smooth scrolling on IE/Edge */
        -ms-overflow-style: none; /* For smooth scrolling on IE/Edge */
        white-space: nowrap;
    }

    .site-menu.js-clone-nav li {
        white-space: nowrap;
    }
}
</style>
<div class="container">
    <div class="row">
             @foreach($products as $product)

        <div class="col col-md-3 mt-3"style="padding-left: 0px!important;">
           <div class="card" >
                     <div class="image-container">
                            @if(count($product->images) > 1)
                                        <!-- Carousel -->
                                        <div id="carousel-{{ $product->productId }}" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach($product->images as $index => $image)
                                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                        <img src="{{ asset('image/' . $image) }}" class="d-block w-100" alt="{{ $product->productName }}" style="height: 200px !important;">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $product->productId }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $product->productId }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    @else
                                        <!-- Single Image -->
                                        <img src="{{ asset('image/' . $product->images[0]) }}" class="card-img-top img-fluid" alt="{{ $product->productName }}" style="height:200px !important;">
                                    @endif                     
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->productId }}">
                                        
                                         <button type="submit"  <a href="#" class="add-to-cart-btn "><span class="fa fa-shopping-cart px-1"></span>Add To Cart</a></button>
                                           
                           
                                     </form>
                                    <form action="{{ route('wishlist.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->productId }}" >
                                        @if ($product->inWishlist)
                                        <button type="submit" class="wishlist-btn clicked" >
                                            <span class="fa fa-heart px-1"></span>
                                        </button>
                                        @else
                                        <button type="submit" class="wishlist-btn" >
                                            <span class="fa fa-heart px-1"></span>
                                        </button>
                                        @endif
                                  </form>


                 </div>
                   <div class="card-body">
            <h6 class="card-title"><a href="{{ route('product.view', $product->productId) }}" class="truncate-text">{{ $product->productName }}</a></h6>
                        <p class="card-text truncate-description"style="margin-bottom:2px; color:black!important;">{{ $product->productDescription}}</p>
                        <p class="card-text "style="margin-bottom:2px; height:38px; color:black!important; margin-top: 15px;">₹{{ $product->productPrice}}</p>
                       <a href="{{ route('product.view', $product->productId) }}" class="btn " style="background: #ec688d;border: 2px solid #ec688d; color: black;
                         width: 200px;">Shop Now</a>

                       <!--<div class="row">-->
                       <!--    <div class="col col-md-6"><a href="#" class="btn btn-primary">Cart</a></div>-->
                       <!--    <div class="col col-md-6"><box-icon name='cart' type='solid'  ></box-icon></div>-->
                       <!--</div>-->

                        
                         
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


<script >

document.addEventListener("DOMContentLoaded", function() {
    const wishlistButtons = document.querySelectorAll(".wishlist-btn");

    // Add event listeners to all wishlist buttons
    wishlistButtons.forEach((button, index) => {
        button.addEventListener("click", function() {
            if (button.classList.contains("clicked")) {
                alert('Product is already in wishlist');
            } else {
                button.classList.add("clicked");
            }
        });
    });

});


</script>

@endsection
