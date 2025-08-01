@extends('frontend.layouts.main')

@section('main-container')
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

<style>
    /* Add this CSS to your stylesheet or in the head of your HTML */
.noUi-target,
.noUi-target * {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -ms-touch-action: none;
    touch-action: none;
    -ms-user-select: none;
    -moz-user-select: none;
    user-select: none;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.noUi-target {
    position: relative;
    direction: ltr;
}

.noUi-base {
    width: 100%;
    height: 100%;
    position: relative;
    z-index: 1;
}

/* Styling for the slider handle */
.noUi-handle {
    position: absolute;
    z-index: 1;
    touch-action: none;
    cursor: grab;
}

.noUi-handle:active {
    cursor: grabbing;
}

.noUi-connect {
    background: #ec688d;
    position: absolute;
    z-index: 1;
}

.noUi-horizontal {
    height: 14px;
}

.noUi-horizontal .noUi-handle {
    width: 18px;
    height: 18px;
    left: 20px;
    top: -3px;
    border-radius: 50%;
    background: #fff;
    border: 2px solid #ec688d;
}

.noUi-tooltip {
    display: block;
    position: absolute;
    background: #ec688d;
    color: #fff;
    border-radius: 3px;
    padding: 5px;
    text-align: center;
    font-size: 12px;
    font-weight: 400;
    white-space: nowrap;
}

.price-filter-container {
    display: flex;
    align-items: center;
    gap: 10px;
}

#price-range {
    margin: 0 10px;
}

/* Add any additional styles for buttons if needed */
.btn {
    margin: 0 5px;
}

/* Style for the noUiSlider */
.noUi-horizontal .noUi-handle {
    width: 18px;
    height: 18px;
    left: 20px;
    top: -3px;
    border-radius: 50%;
    background: #fff;
    border: 2px solid #ec688d;
}

.noUi-tooltip {
    display: block;
    position: absolute;
    background: #ec688d;
    color: #fff;
    border-radius: 3px;
    padding: 5px;
    text-align: center;
    font-size: 12px;
    font-weight: 400;
    white-space: nowrap;
}


</style>


  <div class="container mt-5">
        <form id="filter-form" method="GET" action="{{ route('product.filter') }}">
        <div class="price-filter-container">
            <label for="price-range"><b>Price Range</b></label>
            <div id="price-range" style="width: 336px;"></div>
            <input type="hidden" name="min_price" id="min_price" value="{{ request('min_price', 0) }}">
            <input type="hidden" name="max_price" id="max_price" value="{{ request('max_price', 10000) }}">
            <button type="submit" class="btn" style="background: #ec688d; color:white;">Filter</button>
            <button type="reset" class="btn" style="background: #ec688d; color:white;" onclick="window.location.href='{{ route('product.filter') }}'">Clear</button>
        </div>
    </form>
  </div>

    <h2 class="text-center mt-5">Product List</h2>
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
<?php
    $description = strip_tags($product->productDescription); // Remove HTML tags
    $words = explode(' ', $description); // Split into words
    if (count($words) > 50) {
        $words = array_slice($words, 0, 50); // Keep only the first 50 words
        $description = implode(' ', $words) . '...'; // Rejoin words and add ellipsis
    } else {
        $description = implode(' ', $words); // Use the original description if less than 50 words
    }
?>
                        <p class="card-text truncate-description"style="margin-bottom:2px; color:black!important;">{!! $description !!}</p>
                        <p class="card-text "style="margin-bottom:2px; height:38px; color:black!important; margin-top: 15px;">₹{{ $product->productPrice}}</p>
                       <a href="{{ route('product.view', $product->productId) }}" class="btn " style="background: #ec688d;border: 2px solid #ec688d; color: white;
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

 
  </main>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var priceRange = document.getElementById('price-range');
    var minPriceInput = document.getElementById('min_price');
    var maxPriceInput = document.getElementById('max_price');
    var filterButton = document.getElementById('filter-button');

    if (priceRange) {
        noUiSlider.create(priceRange, {
            start: [parseInt(minPriceInput.value), parseInt(maxPriceInput.value)],
            connect: true,
            range: {
                'min': 0,
                'max': 10000
            },
            tooltips: [true, true],
            format: {
                to: function (value) {
                    return Math.round(value);
                },
                from: function (value) {
                    return Number(value);
                }
            }
        });

        priceRange.noUiSlider.on('update', function (values, handle) {
            if (handle === 0) {
                minPriceInput.value = values[0];
            } else {
                maxPriceInput.value = values[1];
            }
        });

        filterButton.addEventListener('click', function() {
            document.getElementById('filter-form').submit();
        });
    } else {
        console.error('Price range element not found');
    }
});


</script>


@endsection