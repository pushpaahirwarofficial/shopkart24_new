@extends('frontend.layouts.main')

@section('main-container')

    <div class="container">
        <!-- enter Phone Number start -->
        <div class="row justify-content-center" id="phoneNumber">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">{{ __('Guest Login') }}</div>

                    <div class="card-body mt-3">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form id="sendOtpForm" action="{{ route('user.login.sendOtp') }}"  method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>
                                        <!-- Error message container for phone -->
                                        <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn" style="background:#e46d8e; color:white;">
                                        {{ __('Send OTP') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- enter Phone Number end -->

        <!-- enter otp start -->
        <div class="row justify-content-center" id="insertOtp" style="display:none;">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">{{ __('Enter OTP') }}</div>

                    <div class="card-body mt-3">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form id="sendVerifyOtp" action="{{ route('user.login.verifyOtp') }}"  method="POST">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-4 text-center mt-2">
                                    <label for="phoneOTP" class="">{{ __('Mobile Number') }}</label>
                                </div>
                                <div class="col-md-4 text-center">
                                    <input type="text" id="phoneOTP" name="phoneOTP" value="{{ old('phoneOTP') }}" readonly>
                                </div>
                                <div class="col-md-4 text-center">
                                    <input type="text"  id="otp" name="otp" value="{{ old('otp') }}" autocomplete="otp" autofocus>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4  text-center">
                                    <button type="submit" class="btn" style="background:#e46d8e; color:white;">
                                        {{ __('Verify OTP') }}
                                    </button>
                                    <a href="javascript:void(0)" id="backLink" style="">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- enter otp end -->

    </div>
@endsection




<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function() {
    // Show OTP form and hide phone number form
    // Show phone number form and hide OTP form
    $('#backLink').click(function(e) {
        e.preventDefault(); // Prevent default anchor link behavior
        $('#phoneNumber').show(); // Show phone number form
        $('#insertOtp').hide();   // Hide OTP form
        $('#backLink').hide();    // Hide "Back" link
    });
});


$(document).ready(function() {
    
    $('#phone').on('input', function() {
        // Get the value from #phone and set it to #phoneOtp
        $('#phoneOTP').val($(this).val());
    });
    
    $('#sendOtpForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting the default way

        // Serialize the form data
        var formData = $(this).serialize(); // Serializes the entire form data

        $.ajax({
            url: "{{ route('user.login.sendOtp') }}",  // Laravel route
            type: 'POST',  // POST method
            data: formData,  // Send serialized form data
            success: function(response) {
                $('#phone').removeClass('is-invalid');
                $('#phone').next('.invalid-feedback').remove();
                $('#phoneNumber').hide();
                $('#insertOtp').show();
                // $('#sendOtpForm')[0].reset();
            },
            error: function(xhr) {
                // Handle validation errors
                if (xhr.status === 422) {  // Check for validation errors (422 is for unprocessable entity)
                    var errors = xhr.responseJSON.errors;  // Get the errors object
                    // Add the 'is-invalid' class and error message to the phone field
                    if (errors.phone) {
                        $('#phone').addClass('is-invalid');
                        $('#phone').after('<div class="invalid-feedback">' + errors.phone[0] + '</div>');
                    }
                } else {
                    // Handle other errors
                    alert('An error occurred: ' + xhr.statusText);
                }
            }
        });
    });
});

$(document).ready(function() {
    // Handle form submission using AJAX
    $('#sendVerifyOtp').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var form = $(this);
        var formData = form.serialize(); // Serialize the form data

        // Clear previous error messages
        $('.invalid-feedback').text('').hide();
        $('input').removeClass('is-invalid');

        // Send the AJAX request
        $.ajax({
            url: form.attr('action'), // Form action URL
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    // $('#insertOtp')[0].reset(); // Reset the form
                    $('.invalid-feedback').text(response.success).show(); // Show success message
                    console.log('Redirecting to:', response.redirUrl); // Debug URL
                } else {
                    console.error('Unexpected response structure:', response);
                }
                alert('Guest Login successfully');
                window.location.href = "{{ route('checkout') }}"; // Redirect

            },
            error: function(xhr) {
                // Handle validation errors from the server 
                // $('#insertOtp')[0].reset();
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;

                    // Loop through the errors and display them
                    $.each(errors, function(field, messages) {
                        var inputField = $('#' + field);
                        inputField.addClass('is-invalid'); // Add class to highlight invalid field
                        inputField.next('.invalid-feedback').text(messages[0]).show(); // Show error message
                    });
                } else if (xhr.status === 400) {
                    // Handle other errors, e.g., invalid OTP or phone number
                    $('.invalid-feedback').text('Invalid OTP.').show();
                }
            }
        });
    });
});


</script>