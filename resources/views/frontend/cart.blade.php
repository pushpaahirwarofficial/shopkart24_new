@extends('frontend.layouts.main')

@section('main-container')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        #shopify-section-header .megamenu {
            line-height: 1;
        }

        #shopify-section-header .megamenu a {
            font-size: 0.9em;
        }

        #shopify-section-header .site-nav__dropdown-link--second-level {
            font-size: 0.9em;
        }

        #shopify-section-header .h5 a {
            color: #ec688d;
        }

        #shopify-section-header .mobile-nav .appear-delay-2 a {
            color: #ec688d;
        }

        #shopify-section-header .mobile-nav .appear-delay-3 a {
            color: #9b006f;
        }
        .razorpay-payment-button {
            background:#ec688d; color:black;
        }
        
        #addressForm {
            display: none;
        }
   
    </style>
    <div class="container">
    <h1>Your Cart</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (empty($cart))
        <p>Your cart is empty.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th> <!-- New column for delete button -->
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                @php
                        // Calculate total for each item without delivery charges
                        $total = $item['price'] * $item['quantity'];
                        
                        // Split the image string by '|'
                        $images = explode('|', $item['image']);
                        // Get the first image
                        $firstImage = $images[0];
                    @endphp
                <tr>
                    <td><img src="{{ asset('image/' . $firstImage) }}" style="height: 150px;width:200px;" alt="{{ $item['name'] }}"></td>
                    <td>{{ $item['name'] }}</td>
                    <td>₹{{ $item['price'] }}</td>
                   
                    <td>
                        <form action="{{ route('cart.update', $item['product_id']) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" name="action" value="decrease">-</button>
                            {{ $item['quantity'] }}
                            <button type="submit" name="action" value="increase">+</button>
                        </form>
                    </td>
                    <td>₹{{ $total }}</td>
                    <td>
                        <form action="{{ route('cart.delete', $item['product_id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"><i class="fa fa-trash-o btn btn-danger" aria-hidden="true"></i></button>
                            <a href="{{ route('product.view', $item['product_id']) }}" type="submit"><i class="fa fa-eye btn " aria-hidden="true" style="background: #dc3545; color: white;"></i></a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

<div class="cart-view-total">
    <!--<h4>Cart Totals</h4>-->
    <table class="table">
         <tbody>
            @php
                $subtotal = 0;
                $deliveryCharges = 0;
                $subtotalWithCoupons = 0; // For items with matching coupons
                $subtotalWithoutCoupons = 0; // For items without matching coupons
            @endphp
            
            @foreach ($cart as $item)
                @php
                    $hasCoupon = false; // Flag to check if item has a matching coupon
                @endphp
                @foreach ($coupons as $coupon)
                    @if(!empty($item['category_id']))
                        @if ($coupon->product_code == $item['category_id'])
                            @php
                                $totalItemPrice = $item['price'] * $item['quantity'];
                                $subtotalWithCoupons += $totalItemPrice;
                                $hasCoupon = true; // Mark as discounted
                            @endphp
                            @break
                        @endif
                    @endif
                @endforeach
            
                @if (!$hasCoupon)
                    @php
                        $subtotalWithoutCoupons += $item['price'] * $item['quantity'];
                    @endphp
                @endif
            @endforeach
            
            @php $subtotal = $subtotalWithCoupons + $subtotalWithoutCoupons  @endphp


            @php
                // Apply delivery charges based on subtotal
                if ($subtotal < 500) {
                    $deliveryCharges = 60;
                } else {
                    $deliveryCharges = 0;
                }
                
                // Get the discount amount from the hidden input
                $discountAmount = old('discount_amount', 0); // Default to 0 if not set

                // Calculate final total
                $finalTotal = $subtotal + $deliveryCharges;
            @endphp

    @if (!empty($cart))

            <tr>
                <th>Subtotal</th>
                <td>₹{{ $subtotal }}</td>
            </tr>
            <tr>
                <th>Delivery Charges</th>
                <td>₹{{ $deliveryCharges }}</td>
            </tr>

        </tbody>
    </table>
@endif

<style>

.addbtn{
   
   background-color: #977935;
    border: 0px;
    width: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: auto;
    margin-right: auto; 
}
     

</style>

    @if (!empty($cart))

<div class="d-flex justify-content-center mt-4 mb-4">
    @if($order)
        @if($amount > 100)
            <div class="col-md-12">
            
             @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                
            <div style="display: flex; justify-content:center; margin-top: 20px;">
                <a href="{{ route('checkout') }}" class="btn" style="background-color: #ec688d; color: #fff; border: none; border-radius: 3px; padding: 10px 20px; text-decoration: none; cursor: pointer;">
                    Checkout
                </a>
            </div>
    </div>
        <!--@endif-->

    @else


    <div style="display: flex; flex-direction: column;">
        @if(empty(auth()->user()->id))
        <a href="{{ route('user.signinPhone') }}" class="btn" style="background:#ec688d!important; color:white;">Login to Checkout</a><br>
        <a href="{{ route('user.login.mobile') }}" id="customer_register_link_otp" class="btn" style="background:#ec688d!important; color:white;">Guest Login to Checkout</a>

        @else
            <div style="display: flex; justify-content:center; margin-top: 20px;">
                <a href="{{ route('checkout') }}" class="btn" style="background-color: #ec688d; color: #fff; border: none; border-radius: 3px; padding: 10px 20px; text-decoration: none; cursor: pointer;">
                    Checkout
                </a>
            </div>
        @endif
    </div>

    @endif
</div>

             </div>
</div>
        
@endif

        <script>
    document.getElementById('toggleFormBtn').addEventListener('click', function() {
        var form = document.getElementById('addressForm');
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    });
</script>
        
 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Trigger form submission when a radio button is selected
        $('input[name="coupon_code"]').on('change', function() {
            $('#apply-coupon-form').submit(); // Submit the form
        });

        $('#apply-coupon-form').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            
            $.ajax({
                url: "{{ route('apply.coupon') }}", // Get the action URL from the form
                type: 'POST',
                data: $(this).serialize(), // Serialize the form data
                success: function(response) {
                    
                    console.log(response);
                    // Display success message
                    $('#coupon-message').html('<div class="alert alert-success">Coupon applied successfully!</div>');
                
                    let deliveryCharge = 60;
                    let subtotalWithCoupons = {{ $subtotalWithCoupons }}; // Original amount from your Blade template
                    let subtotalWithoutCoupons = {{ $subtotalWithoutCoupons }};
                    let discountAmount = response.new_amount.discount_amount; // Get the discount amount from the response
                    let discountType = response.new_amount.discount_type; // Get the discount type from the response
                
                    if (discountType === 'percent') {
                        // Calculate the discount amount based on percentage
                        discountAmount = (subtotalWithCoupons * discountAmount) / 100; // Calculate the discount in terms of currency
                    }
                
                    // Subtract the discount amount from the original order amount
                    let newAmount = (subtotalWithCoupons - discountAmount) / 100; // Convert to rupees
                
                    // Update Razorpay amount (in paise)
                    $('#newPrice').text('₹' + (subtotalWithCoupons - discountAmount + subtotalWithoutCoupons + deliveryCharge).toFixed(2));
                
                    // Populate the discount details in the form
                    $('#discount_amount').val(discountAmount);
                    $('#discount_type').val(discountType);
                    $('#discountAmoutPrice').val(discountAmount);
                },
                error: function(xhr) {
                    // Display error message
                    var errorMessage = xhr.responseJSON.message || 'An error occurred while applying the coupon.';
                    $('#coupon-message').html('<div class="alert alert-danger">' + errorMessage + '</div>');
                }
            });
        });
    });
</script>
 
 
        
    @endsection
