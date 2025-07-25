@extends('frontend.layouts.main')

@section('main-container')

<style>
/* Add your CSS styles here */
.aa-prod-view-size a{
    border: 1px solid #ddd;
    display: inline-block;
    font-size: 14px;
    color:black;
    letter-spacing: 0.5px;
    margin-bottom: 5px;
    margin-right: 8px;
    padding: 5px 10px;
    transition: all 0.5s ease 0s;
}

.box {
    background: #f5f5f5;
    display: inline-flex;
    padding: 0;
    width:80px;
    border: 1px solid var(--tb-border-color);
}
.buycartbtn{
    background: #ec688d;
    border-radius: 5px;
    border-color: #ec688d;
    padding: 10px;
    width: 170px;
}
</style>
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

.star-ratingss {
    direction: rtl;
    display: inline-block;
    font-size: 2em;
    unicode-bidi: bidi-override;
}

.star-ratingss input[type="radio"] {
    display: none;
}

.star-ratingss label {
    color: #ccc; /* Gray color for unselected stars */
    cursor: pointer;
    display: inline-block;
}

.star-ratingss input:checked ~ label {
    color: #fc0; /* Gold color for selected stars */
}

.star-ratingss label:hover,
.star-ratingss label:hover ~ label {
    color: #fc0; /* Gold color on hover */
}

 .star {
        font-size: 24px; /* Adjust size as needed */
        color: #ccc; /* Color for empty stars */
        margin-right: 2px; /* Space between stars */
    }

    .star.filled {
        color: #fc0; /* Color for filled stars */
    }
</style>


<div class="container">

    <div class="row mt-5 mb-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="col col-md-5 col-lg-5 col-xl-5 col-12">
            <img id="mainImage" src="{{ asset('image/' . $product->images[0]) }}" class="card-img-top img-fluid" alt="{{ $product->productName }}">
            @if(count($product->images) > 1)
                <div class="row mt-3">
                    @foreach($product->images as $image)
                        <div class="col-3">
                            <img class="thumbnail img-fluid" src="{{ asset('image/' . $image) }}" alt="{{ $product->productName }}">
                        </div>
                    @endforeach
                </div>
                <div class="quantity" style="min-width:128px; margin-top:5px;">
                    <div class="row d-flex justify-content-center align-items-center" style="gap: 10px;">
                        <div class="col-auto">
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->productId }}">
                                <button type="submit" name="add-to-cart" value="7822" class="btn btn-primary buycartbtn">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                        <div class="col-auto">
                            <form action="{{ route('wishlist.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->productId }}">
                                <button type="submit" name="add-to-wishlist" value="7822" class="btn btn-primary buycartbtn">
                                    Add to Wishlist
                                </button>
                            </form>
                        </div>
                    </div>
            </div>
            @endif
        </div>

        <div class="col col-md-7 col-lg-7 col-xl-7 col-12">
            <h2 class="card-title fw-600" style="color: #ec688d; font-weight: 600;">{{ strtoupper($product->productName) }}</h2>
            <p class="card-text" style="color:black; font-size: x-large;height: 1.5em;">Price: ₹{{ $product->productPrice }}</p>
            <p class="card-text" style="color:black;">{!! $product->productDescription !!}</p>

            <!--<div class="quantity" style="min-width:128px;">-->
            <!--    <div class="row mt-5">-->
            <!--        <form action="{{ route('cart.add') }}" method="POST">-->
            <!--            @csrf-->
            <!--            <input type="hidden" name="product_id" value="{{ $product->productId }}">-->
            <!--            <div class="col col-md-6">-->
            <!--                <button type="submit" name="add-to-cart" value="7822" class="buycartbtn" style="color:white;">Add to cart</button>-->
            <!--            </div>-->
            <!--        </form>-->
            <!--    </div>-->
            <!--</div>-->
            <hr>
<style>
    .review-container {
        display: inline-block;
    }

    .review-container p {
        display: inline-block;
        margin: 0; /* Optional: to remove default margin */
    }

    .review-container strong {
        margin-right: 5px; /* Optional: to add space between name and review */
    }
</style>
<!-- Reviews Section -->
<h3>Reviews</h3>
@foreach($product->reviews as $review)
    <div class="review">
        <div class="review-container">
            <strong>{{ $review->user->name }}</strong>
            <p>{{ $review->review }}</p>
            <!--{{ dump($review->medias) }}-->
           @if ($review->medias && $review->medias->count())
                <div class="review-media">
                    @foreach($review->medias as $media)
                        @if (Str::endsWith($media->path, ['.jpg', '.jpeg', '.png']))
                            <img src="{{ Storage::url($media->path) }}" alt="Review Image" style="max-width: 100px; height: 100px; padding:10px;">
                        @elseif (Str::endsWith($media->path, ['.mp4', '.mov', '.avi']))
                            <!--<video controls style="max-width: 100%; height: auto;">-->
                            <!--    <source src="{{ Storage::url($media->path) }}" type="video/mp4">-->
                            <!--    Your browser does not support the video tag.-->
                            <!--</video>-->
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
        <p>Rating:
            @for ($i = 1; $i <= 5; $i++)
                <span class="star {{ $i <= $review->rating ? 'filled' : '' }}">&#9733;</span>
            @endfor
        </p>
    </div>
    <hr>
@endforeach

<!-- Add/Edit Review Form -->
@if (Auth::check())
    @if ($hasPurchased)
        @if ($existingReview)
            <h3>Edit Your Review</h3>
            <form action="{{ route('product.updateReview', $product->productId) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="review_id" value="{{ $existingReview->id }}">
                <div class="form-group">
                    <label for="review">Your Review</label>
                    <textarea name="review" id="review" rows="4" class="form-control" required>{{ $existingReview->review }}</textarea>
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <div class="star-ratingss">
                        <input type="radio" id="5-stars" name="rating" value="5" {{ $existingReview->rating == 5 ? 'checked' : '' }} />
                        <label for="5-stars" class="star">&#9733;</label>
                        <input type="radio" id="4-stars" name="rating" value="4" {{ $existingReview->rating == 4 ? 'checked' : '' }} />
                        <label for="4-stars" class="star">&#9733;</label>
                        <input type="radio" id="3-stars" name="rating" value="3" {{ $existingReview->rating == 3 ? 'checked' : '' }} />
                        <label for="3-stars" class="star">&#9733;</label>
                        <input type="radio" id="2-stars" name="rating" value="2" {{ $existingReview->rating == 2 ? 'checked' : '' }} />
                        <label for="2-stars" class="star">&#9733;</label>
                        <input type="radio" id="1-stars" name="rating" value="1" {{ $existingReview->rating == 1 ? 'checked' : '' }} />
                        <label for="1-stars" class="star">&#9733;</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="media">Upload Image (optional)</label>
                    <input type="file" name="media[]" id="media" class="form-control" multiple accept="image/*,video/*">
                </div>

                <button type="submit" class="btn mt-2" style="background: #ec688d;border: 2px solid #ec688d; color: white;">Update Review</button>
            </form>
        @else
            <h3>Submit Your Review</h3>
            <form action="{{ route('product.addReview', $product->productId) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="review">Your Review</label>
                    <textarea name="review" id="review" rows="4" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <div class="star-ratingss">
                        <input type="radio" id="5-stars" name="rating" value="5" required />
                        <label for="5-stars" class="star">&#9733;</label>
                        <input type="radio" id="4-stars" name="rating" value="4" />
                        <label for="4-stars" class="star">&#9733;</label>
                        <input type="radio" id="3-stars" name="rating" value="3" />
                        <label for="3-stars" class="star">&#9733;</label>
                        <input type="radio" id="2-stars" name="rating" value="2" />
                        <label for="2-stars" class="star">&#9733;</label>
                        <input type="radio" id="1-stars" name="rating" value="1" />
                        <label for="1-stars" class="star">&#9733;</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="media">Upload Image/Video (optional)</label>
                    <input type="file" name="media[]" multiple name="media" id="media" class="form-control-file">
                </div>

                <button type="submit" class="btn mt-2" style="background: #ec688d;border: 2px solid #ec688d; color: white;">Submit Review</button>
            </form>
        @endif
    @else
        <p>Please purchase the product to leave a review.</p>
    @endif
@else
    <p>Please <a href="{{ route('user.login') }}">log in</a> to leave a review.</p>
@endif



        </div>
    </div>
    
                
                <!-- Related Products Section -->
    <div class="row">
        <div class="col-12">
            <h3 class="fw-600" style="color: #ec688d;">Related Products</h3>
        </div>
        @foreach($product->relatedProducts as $relatedProduct)
            <div class="col col-md-3 mt-3"style="padding-left: 0px!important;">
           <div class="card" >
                <div class="image-container">
                            @if(count($relatedProduct->images) > 1)
                                        <!-- Carousel -->
                                        <div id="carousel-{{ $relatedProduct->productId }}" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach($relatedProduct->images as $index => $image)
                                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                        <img src="{{ asset('image/' . $image) }}" class="d-block w-100" alt="{{ $relatedProduct->productName }}" style="height: 200px !important;">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $relatedProduct->productId }}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $relatedProduct->productId }}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    @else
                                        <!-- Single Image -->
                                        <img src="{{ asset('image/' . $relatedProduct->images[0]) }}" class="card-img-top img-fluid" alt="{{ $relatedProduct->productName }}" style="height:200px !important;">
                                    @endif                     
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $relatedProduct->productId }}">
                                        
                                         <button type="submit"  <a href="#" class="add-to-cart-btn "><span class="fa fa-shopping-cart px-1"></span>Add To Cart</a></button>
                                           
                           
                                     </form>
                                    <form action="{{ route('wishlist.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $relatedProduct->productId }}" >
                                        @if ($relatedProduct->inWishlist)
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
                            <h6 class="card-title"><a href="{{ route('product.view', $relatedProduct->productId) }}" class="truncate-text">{{ $relatedProduct->productName }}</a></h6>

            
<?php
    $description = strip_tags($relatedProduct->productDescription); // Remove HTML tags
    $words = explode(' ', $description); // Split into words
    if (count($words) > 50) {
        $words = array_slice($words, 0, 50); // Keep only the first 50 words
        $description = implode(' ', $words) . '...'; // Rejoin words and add ellipsis
    } else {
        $description = implode(' ', $words); // Use the original description if less than 50 words
    }
?>
                        <p class="card-text truncate-description"style="margin-bottom:2px; color:black!important;">{!! $description !!}</p>
                        <p class="card-text "style="margin-bottom:2px; height:38px; color:black!important; margin-top: 15px;">₹{{ $relatedProduct->productPrice}}</p>
                       <a href="{{ route('product.view', $relatedProduct->productId) }}" class="btn " style="background: #ec688d;border: 2px solid #ec688d; color: white;
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.thumbnail').click(function() {
            var imageUrl = $(this).attr('src');
            $('#mainImage').attr('src', imageUrl);
        });
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star-rating label');
    
    function updateStarColors(rating) {
        stars.forEach(star => {
            star.style.color = parseInt(star.getAttribute('for').split('-')[0]) <= rating ? '#fc0' : '#ccc';
        });
    }

    stars.forEach(star => {
        star.addEventListener('mouseover', function() {
            const rating = parseInt(this.getAttribute('for').split('-')[0]);
            updateStarColors(rating);
        });

        star.addEventListener('mouseout', function() {
            const checkedRating = parseInt(document.querySelector('.star-rating input:checked')?.value) || 0;
            updateStarColors(checkedRating);
        });
    });

    // Ensure stars are colored correctly on page load if already selected
    const initialRating = parseInt(document.querySelector('.star-rating input:checked')?.value) || 0;
    updateStarColors(initialRating);
});
</script>

@endsection
