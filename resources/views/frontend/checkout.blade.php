@extends('frontend.layouts.main')

@section('main-container')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <div class="container">
        <h1 class="text-center">Checkout</h1>
    <div class="checkout-container">
        <!-- Delivery Section -->
        <div class="delivery-section">
            <h6>Account</h6>
            @if(!empty($userId) && $userData->name != 'temp name' && $userData->password != 'temp password' )
            <p>Email: {{ $userData->email }}</p>
            @elseif(!empty($userId) && $userData->name == 'temp name' && $userData->password == 'temp password' )
            <p>Phone: {{ $userData->phone }}</p>
            @else
            <p><a href="{{ url('user.signinPhone') }}">Login</a></p>
            @endif

            <h2>Delivery</h2>
            <form id="paymentDataStore" action="{{ route('checkout.address') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="country">Country/Region</label>
                    <select id="country" name="country">
                        <option value="india">India</option>
                    </select>
                </div>

                <div class="form-group-col">
                    <div class="form-group-name">
                        <label for="first-name">First Name</label>
                        <input type="text" name="first_name" id="first-name" value="ram">
                    </div>
    
                    <div class="form-group-name">
                        <label for="last-name">Last Name</label>
                        <input type="text" name="last_name" id="last-name" value="kapoor">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" value="Bhopal Square">
                </div>

                <div class="form-group">
                    <label for="apartment">Apartment, suite, etc.</label>
                    <input type="text" name="apartment" id="apartment" value="apartment">
                </div>

                <div class="form-group-three">
                    <div class="form-group-three-name">
                        <label for="billing-city">City</label>
                        <input type="text" name="billing_city" id="billing-city" value="Dewas">
                    </div>
    
                    <div class="form-group-three-name">
                        <label for="billing-state">State</label>
                        <select id="billing-state-1" name="billing_state_1">
                            <option>Select</option>
                        </select>
                    </div>

                    <div class="form-group-three-name">
                        <label for="billing-pin">PIN code</label>
                        <input type="text" id="billing-pin" name="billing_pin" value="455001">
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="8989011234">
                </div>

                <div class="form-group">
                    <h6>Shipping Method</h6>
                    <p style="margin-bottom:0px;">
                        <input type="radio" id="online-payment" name="payment_type" value="online" checked>
                        <label for="online-payment"><strong>Online Payment</strong> - Free</label>
                    </p>
                    <p>
                        <input type="radio" id="cod" name="payment_type" value="cod">
                        <label for="cod"><strong>Cash On Delivery</strong></label>
                    </p>
                </div>

                <h2>Payment</h2>
                <p>All transactions are secure and encrypted.</p>

                <div class="option">
                    <div class="payment-method-row">
                        <input type="radio" id="razorpay" name="payment_method" value="razorpay" checked>
                        <label for="razorpay">
                            Razorpay Secure (UPI, Cards, Wallets, NetBanking)
                        </label>
                            <img alt="upi" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/c1.en/assets/upi.CmgCfll8.svg" role="img" width="38" height="24" class="_1tgdqw61 _1tgdqw60 _1fragemsf _1fragemsa _1fragemsp _1fragemoc _1tgdqw66">
                            <img alt="visa" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/c1.en/assets/visa.sxIq5Dot.svg" role="img" width="38" height="24" class="_1tgdqw61 _1tgdqw60 _1fragemsf _1fragemsa _1fragemsp _1fragemoc _1tgdqw66">
                            <img alt="master" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/c1.en/assets/master.CzeoQWmc.svg" role="img" width="38" height="24" class="_1tgdqw61 _1tgdqw60 _1fragemsf _1fragemsa _1fragemsp _1fragemoc _1tgdqw66">
                            <img alt="rupay" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/c1.en/assets/rupay.Bl62X6PG.svg" role="img" width="38" height="24" class="_1tgdqw61 _1tgdqw60 _1fragemsf _1fragemsa _1fragemsp _1fragemoc _1tgdqw66">
                    </div>
                    <br>
                    <div class="option">
                        <div class="payment-method-row">
                        <input type="radio" id="phonepe" name="payment_method" value="phonepe">
                        <label for="phonepe">
                            PhonePe Payment Gateway (UPI, Cards & NetBanking)
                        </label>
                            <img alt="upi" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/c1.en/assets/upi.CmgCfll8.svg" role="img" width="38" height="24" class="_1tgdqw61 _1tgdqw60 _1fragemsf _1fragemsa _1fragemsp _1fragemoc _1tgdqw66">
                            <img alt="visa" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/c1.en/assets/visa.sxIq5Dot.svg" role="img" width="38" height="24" class="_1tgdqw61 _1tgdqw60 _1fragemsf _1fragemsa _1fragemsp _1fragemoc _1tgdqw66">
                            <img alt="master" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/c1.en/assets/master.CzeoQWmc.svg" role="img" width="38" height="24" class="_1tgdqw61 _1tgdqw60 _1fragemsf _1fragemsa _1fragemsp _1fragemoc _1tgdqw66">
                            <img alt="rupay" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/c1.en/assets/rupay.Bl62X6PG.svg" role="img" width="38" height="24" class="_1tgdqw61 _1tgdqw60 _1fragemsf _1fragemsa _1fragemsp _1fragemoc _1tgdqw66">
                        </div>
                    </div>
                </div>
    
                <br>

                <h6>Billing Address</h6>
                <div class="billing-address-options">
                    <input type="radio" id="same-address" name="billing_address_select" value="shipping" checked>
                    <label for="same-address">Same as shipping address</label><br>
                    <input type="radio" id="different-address" name="billing_address_select" value="billing">
                    <label for="different-address">Use a different billing address</label>
                </div>

                <!-- Billing address form fields (display when "Use a different billing address" is selected) -->
                <div class="billing-form" id="billing-form">
                    <div class="form-group">
                        <label for="billing-country">Country/Region</label>
                        <select id="billing-country" name="billing_country"> 
                            <option>India</option>
                        </select>
                    </div>
    
                    <div class="form-group-col">
                        <div class="form-group-name">
                            <label for="billing-first-name">First Name</label>
                            <input type="text" id="billing-first-name" name="billing_first_name" value="ram">
                        </div>
        
                        <div class="form-group-name">
                            <label for="billing-last-name">Last Name</label>
                            <input type="text" id="billing-last-name" name="billing_last_name" value="kapoor">
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="billing-address">Address</label>
                        <input type="text" id="billing-address" name="billing_address_11" value="Bhopal Square">
                    </div>
    
                    <div class="form-group">
                        <label for="billing-apartment">Apartment, suite, etc.</label>
                        <input type="text" id="billing-apartment" name="billing_apartment_11" value="apartment 1">
                    </div>
    
                    <div class="form-group-three">
                        <div class="form-group-three-name">
                            <label for="billing-city">City</label>
                            <input type="text" id="billing-city" name="billing_city_11" value="Dewas">
                        </div>
        
                        <div class="form-group-three-name">
                            <label for="billing-state">State</label>
                            <select id="billing-state" name="billing_state_11">
                            </select>
                        </div>
    
                        <div class="form-group-three-name">
                            <label for="billing-pin">PIN code</label>
                            <input type="text" id="billing-pin" name="billing_pin_11" value="455001">
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="billing-phone">Phone (optional)</label>
                        <input type="text" id="billing-phone" name="billing_phone_11" value="1234567890">
                    </div>
                </div>
                    <button type="submit" name="paynow" id="paynow" style="background-color:#ec688d; color:#fff; width:100%;  border: none; border-radius: 1px; cursor: pointer;">Pay now</span></span></button>
                </form>
            </div>
        
        
        <!-- Order Summary Section -->
        <div class="summary-section">
            <h2>Order Summary</h2>
            
            @php
                $productIds = array_column($cart, 'product_id');
                $products = DB::table('product')->whereIn('productId', $productIds)->get()->keyBy('productId');
                $totalPrice = 0;
                $categories = [];
            @endphp
            
            @foreach($cart as $cartItem)
                @php 
                    $product = $products[$cartItem['product_id']];
                    $string = $product->image;
                    $result = explode('|', $string);
                    $totalPrice += $product->productPrice * $cartItem['quantity'];
                    $categories[] = $product->categoryId;
                @endphp
                <div class="item">
                    <div style="position: relative; display: inline-block; width: 100px; height: 100px;">
                        <!-- Quantity Badge -->
                        <span style="
                            position: absolute;
                            top: 5px;
                            left: 5px;
                            background-color: #ec688d;
                            color: #fff;
                            padding: 3px 8px;
                            font-size: 12px;
                            border-radius: 12px;
                            font-weight: bold;
                        ">
                            {{ $cartItem['quantity'] }}
                        </span>
                        
                        <!-- Product Image -->
                        <img src="{{ asset('image/' . $result[0]) }}" alt="{{ $result[0] }}" style="width: 100%; height: 100%; border-radius: 5px;">
                    </div>
                    <p>{{ $product->productName }}</p>
                    <p>₹{{ $product->productPrice*$cartItem['quantity'] }}</p>
                </div>
            @endforeach

            <div id="displayCoupon">

            </div>

            <div style="display: block; justify-content: start; margin-top: 20px;">
                <form action="{{ route('apply.coupon.verify') }}" id="addCoupon" method="POST">
                    @csrf
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input type="hidden" name="totalPrice" id="totalPrice" value="{{ $totalPrice+60 }}" required>
                        <input type="hidden" name="categories" id="categories" value="{{ json_encode($categories) }}" required>
                        <input type="text" name="coupon_code" required style="width: 70%; padding: 10px; border-radius: 1px; border: 1px solid #ccc;">
                        <button style="width: 30%; background-color: #ec688d; color: #fff; padding: 10px 20px; border: none; border-radius: 1px; cursor: pointer;">
                            Apply
                        </button>
                    </div>
                </form>
            </div><br>

            <div class="totals">
                <p>Subtotal: ₹{{ $totalPrice }}</p>
                <p>Shipping: ₹60</p>
                <p style="display: flex; justify-content: space-between; margin: 10px 0; font-weight: bold;">
                    <span>Total:</span>
                    <span id="totalPriceAfterCoupon">₹{{ $totalPrice+60 }}</span>
                </p>
                <p style="display: flex; justify-content: end; margin: 0px 0; font-weight: bold;">
                    <span id="couponApplied" style="color: #ec688d;"></span>
                </p>
            </div>
        </div>
    </div>

    <div id="your-target-div">
    <!-- Loaded content will appear here -->
</div>

<script>
        // JavaScript to toggle the billing address form visibility
        const sameAddressRadio = document.getElementById('same-address');
        const differentAddressRadio = document.getElementById('different-address');
        const billingForm = document.getElementById('billing-form');

        differentAddressRadio.addEventListener('change', () => {
            billingForm.style.display = 'block';
        });

        sameAddressRadio.addEventListener('change', () => {
            billingForm.style.display = 'none';
        });
        
        
const states = [
    "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh",
    "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jharkhand", "Karnataka",
    "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram",
    "Nagaland", "Odisha", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana",
    "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal", "Andaman and Nicobar Islands",
    "Chandigarh", "Dadra and Nagar Haveli and Daman and Diu", "Lakshadweep", "Delhi",
    "Puducherry", "Ladakh"
];

// Function to populate the select element
function populateSelect(selectId) {
    const selectElement = document.getElementById(selectId);
    
    states.forEach(state => {
        const option = document.createElement("option");
        option.value = state;
        option.textContent = state;
        selectElement.appendChild(option);
    });
}

// Populate both select elements
populateSelect("billing-state");
populateSelect("billing-state-1");

        
    </script>
        
    </div>

@endsection


<style>

    .payment-method-images {
        display: flex;
        align-items: center;  /* Vertically center the images */
        gap: 10px;            /* Space between images */
        flex-wrap: nowrap;     /* Prevent wrapping */
        justify-content: space-between;
    }

    .payment-method-images img {
        height: 24px;         /* Fixed height for consistency */
        width: auto;          /* Maintain aspect ratio */
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .payment-method-images {
            justify-content: space-around; /* Distribute images evenly */
        }
        .payment-method-images img {
            height: 20px; /* Reduce image size for smaller screens */
        }
    }

    @media (max-width: 480px) {
        .payment-method-images {
            flex-wrap: wrap; /* Allow images to wrap if necessary */
            justify-content: center; /* Center images on small screens */
        }

        .payment-method-images img {
            height: 20px; /* Further reduce image size */
            margin-bottom: 5px; /* Space between images on smaller screens */
        }
    }

    /* Base Styles */
    .payment-method-row {
        display: flex;
        align-items: center;  /* Vertically center the radio button and label */
        gap: 10px;            /* Space between the radio button and the label */
    }

    .payment-method-row input[type="radio"] {
        margin: 0;            /* Remove default margin for radio button */
    }

    .payment-method-row label {
        font-size: 16px;      /* Optional: Customize the font size */
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .checkout-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 20px;
    }

    .account-section, .delivery-section, .shipping-method, .payment-method, .billing-address, .summary-section {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 48%;
        margin-bottom: 20px;
    }

    h2 {
        font-size: 1.2em;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-size: 0.9em;
        color: #555;
    }

    input[type="text"], select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Ensure the container for both fields takes full width */
    .form-group-col {
        width: 100% !important;
        display: flex; /* Use flexbox to arrange child elements in a row */
        gap: 10px; /* Space between the two fields */
        padding: 8px !important;
        margin-top: 5px !important;
        margin-bottom: 5px !important;
    }

    /* Each input container will take up 49% of the width */
    .form-group-name {
        width: 50% !important;
    }

    /* Optional: Adjust input field styles */
    .form-group-name input[type="text"]. select {
        width: 100%; /* Ensure the input fields take up the full width of the container */
        padding: 5px;
        margin-top: 5px;
    }


    /* Ensure the container for both fields takes full width */
    .form-group-three {
        width: 100% !important;
        display: flex; /* Use flexbox to arrange child elements in a row */
        gap: 5px; /* Space between the two fields */
        padding: 8px !important;
        margin-top: 5px !important;
        margin-bottom: 5px !important;
    }

    /* Each input container will take up 49% of the width */
    .form-group-three-name {
        width: 33% !important;
    }

    /* Optional: Adjust input field styles */
    .form-group-three-name input[type="text"], select {
        width: 100%; /* Ensure the input fields take up the full width of the container */
        padding: 5px;
        margin-top: 5px;
    }



    input[type="checkbox"], input[type="radio"] {
        margin-right: 10px;
    }

    button {
        padding: 8px 15px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
    }

    .payment-options .option {
        margin-bottom: 10px;
    }

    .billing-address-options {
        margin-bottom: 10px;
    }

    .billing-form {
        display: none;
        margin-top: 10px;
    }

    .summary-section .totals {
        font-weight: bold;
    }

    .summary-section .item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .discount-code {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    /* Basic styles for icons */
    .payment-options .option i {
        margin-right: 8px;
        font-size: 24px;
    }

    /* Colorful icons */
    .payment-options .option .visa-icon {
        color: #1A1F71; /* Visa Blue */
    }

    .payment-options .option .mastercard-icon {
        color: #EB001B; /* Mastercard Red */
    }

    .payment-options .option .rupay-icon {
        color: #3B8C3A; /* RuPay Green */
    }

    .payment-options .option .phonepe-icon {
        color: #00C0F0; /* PhonePe Blue */
    }

    .payment-options .option span {
        font-size: 14px;
        color: #555;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        /* Stack sections vertically for smaller screens */
        .checkout-container {
            flex-direction: column;
            padding: 15px;
        }

        .account-section, .delivery-section, .shipping-method, .payment-method, .billing-address, .summary-section {
            width: 100%;  /* Full width for each section on smaller screens */
            margin-bottom: 15px;
        }

        /* Make the form inputs and buttons more compact */
        .form-group input[type="text"], .form-group select {
            padding: 10px;
        }

        button {
            padding: 10px 20px;
            width: 100%;  /* Full-width buttons for mobile */
        }

        /* Adjust icon size for smaller screens */
        .payment-options .option i {
            font-size: 20px;  /* Smaller icons on mobile */
        }

        .payment-method-row {
            flex-direction: column;
            align-items: flex-start; /* Stack items vertically */
        }

        .payment-method-row label {
            font-size: 14px;  /* Adjust font size for labels */
        }
    }

    /* For very small screens */
    @media (max-width: 480px) {
        .summary-section .item {
            flex-direction: column; /* Stack items vertically in the summary */
            align-items: flex-start;
        }

        .discount-code {
            flex-direction: column; /* Stack discount input and button vertically */
            align-items: flex-start;
        }

        .checkout-container {
            padding: 10px;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    var couponDestroyUrl = @json(route('coupon.destroy'));

    $(document).ready(function() {
        $('#addCoupon').on('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting normally

            var formData = $(this).serialize(); // Serialize the form data

            // Send the data using AJAX
            $.ajax({
                url: $(this).attr('action'), // Use the action attribute of the form
                type: 'POST',
                data: formData, // Send the serialized form data
                success: function(response) {
                    if (response.success) {
                        $('#totalPriceAfterCoupon').text('₹' + response.new_amount);
                        $('#couponApplied').html('<a href="' + couponDestroyUrl + '" style="color:#ec688d;">Remove Coupon</a>');
                        $('#displayCoupon').html(`
                            <div id="couponBox" style="display: none; justify-content: start; margin-top: 20px; width: 60%; height: auto; padding: 10px; border: 1px solid #ccc; background-color: #ec688d; color: white; border-radius: 16px;">
                                Buy ${response.cat_name}, get extra ${response.coupon.discount_amount} ${response.suffix} off.<br>
                                Use code: <strong>${response.coupon.code}</strong><br>       
                            </div>
                        `);
                        $('#couponBox').fadeIn(200); // Smoothly display the coupon


                    } else {
                        alert("Invalid Token for this order"); // Handle invalid coupon message
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    alert('An error occurred while applying the coupon.');
                }
            });
        });
    });
    
    // $(document).ready(function () {
        
    //     const $payNowButton = $('#paynow');

    //     $('#paymentDataStore').submit(function (e) {
            
    //         $payNowButton.prop('disabled', false);
    //         e.preventDefault(); // Prevent form submission
    //         let formData = $(this).serialize(); // Serialize form data

    //         $.ajax({
    //             url: $(this).attr('action'), // Get the form's action URL
    //             method: $(this).attr('method'), // Get the form's method
    //             data: formData,
    //             success: function (response) {
    //                 $payNowButton.prop('disabled', true);
    //                 if (response.payment_type === 'online') {
    //                     $('#your-target-div').html(response.html); // Inject the Blade view HTML into a div
    //                 } else if (response.payment_type === 'cod') {
    //                     window.location.href = response.redirect_url;
    //                 }

    //             },
    //             error: function (xhr) {
    //                 if (xhr.status === 422) { // Laravel validation error
    //                     let errors = xhr.responseJSON.errors;

    //                     // Clear any existing error messages
    //                     $('.error').remove();

    //                     // Loop through errors and display them
    //                     for (const [field, messages] of Object.entries(errors)) {
    //                         $(`[name="${field}"]`).after(`<span class="error" style="color:red;">${messages[0]}</span>`);
    //                     }
    //                 }
    //                 $payNowButton.prop('disabled', false);
    //             }
    //         });
    //     });
    // });
    
</script>





