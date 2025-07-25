@extends('frontend.layouts.main')

@section('main-container')
<style> 
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

.item-title a{
    color:black;
    margin-right: 62px;
}
.item-title {
    margin-top: 20px;
font-weight: 400;
text-transform: uppercase;
font-size: .145833333in;
letter-spacing: 2px;
    text-align:center;

}
.item{
    text-align:center;
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
  
  </style>
    <h2 class="text-center">Search Results for "{{ $query }}"</h2>
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
                <a href="{{ route('product.view', $product->productId) }}" class="truncate-text" style="font-size: 14px;">{{ $product->productName }}</a>
            </h6>
            <p class="card-text truncate-description" style="margin-bottom:2px; color:black;">{{ $product->productDescription }}</p>
            <p class="card-text" style="margin-bottom:2px; height:38px; color:black; margin-top: 15px;"><b style="font-size:20px;">₹{{ $product->productPrice }}</b></p>
           <div class="text-center">
                <a href="{{ route('product.view', $product->productId) }}" class="btn" > <button style="background: #ec688d; border: 2px solid #ec688d; color: white; width: 106px; font-size:12px; padding-bottom: 2px; padding-top: 2px;">SHOP NOW</button></a>

           </div>
        </div>
    </div>
</div>

        @endforeach
    </div>
    @endsection
