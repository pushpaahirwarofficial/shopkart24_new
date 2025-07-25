@extends('frontend.layouts.dashboard')
@section('title', 'coupon')

@section('content')


    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
<form action="{{ route('admin.updateCoupons') }}" method="POST" id="updateCouponForm">
    @csrf
    <input type="hidden" class="form-control" id="categoryId" name="categoryId" value="{{ $coupon->id }}" required>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="product_name">Category Name</label>
            <!--<input type="text" class="form-control" id="product_name" name="product_name" value="For All" required readonly>-->
            <select class="form-control" id="product_name" name="product_name" required>
                <option value="">Select Category</option>
                @if(!empty($category))
                    @foreach($category as $cat)
                        <option value="{{ $cat->categoryId }}" 
                            {{ ($coupon->product_code == $cat->categoryId) ? 'selected' : '' }}>
                            {{ $cat->categoryName }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        
        <div class="form-group col-md-12">
            <label for="couponName">Coupon Code</label>
            <input type="text" class="form-control" id="couponName" name="couponName" value="{{ $coupon->code }}" required>
        </div>
        
        <div class="form-group col-md-12">
            <label for="discountType">Discount Type</label>
            <select class="form-control" id="discountType" name="discount_type" required>
                <option value="fixed" {{ $coupon->discount_type == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                <option value="percent" {{ $coupon->discount_type == 'percent' ? 'selected' : '' }}>Percentage</option>
            </select>
        </div>
        
        <div class="form-group col-md-12">
            <label for="discount_amount">Discount Amount</label>
            <input type="number" class="form-control" id="discount_amount" name="discount_amount" value="{{ $coupon->discount_amount }}" required>
        </div>
        
        <div class="form-group col-md-12">
            <label for="expire_at">Expire At</label>
            <input type="date" class="form-control" id="expire_at" name="expire_at" value="{{ $coupon->expires_at }}" required>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-5">Submit</button>
</form>

<div id="error-message" class="alert alert-danger" style="display:none;"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('form').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Prepare form data
        var formData = $(this).serialize(); // Serialize form data

        $.ajax({
            url: $(this).attr('action'), // The URL to send the request to
            method: 'POST', // The HTTP method
            data: formData, // The serialized form data
            success: function(response) {
                // Handle success response
                // Optionally, redirect to another page or refresh the current page
                window.location.href = "{{ route('admin.allcoupons') }}"; // Redirect to coupons list
            },
            error: function(xhr) {
                // Handle validation errors
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors; // Get the validation errors
                    var errorMessage = '<ul>';
                    $.each(errors, function(key, value) {
                        errorMessage += '<li>' + value[0] + '</li>'; // Display first error message for each field
                    });
                    errorMessage += '</ul>';
                    $('#error-message').html(errorMessage).show(); // Show error messages
                } else {
                    alert('An error occurred. Please try again.'); // Handle other errors
                }
            }
        });
    });
});
</script>



 @endsection