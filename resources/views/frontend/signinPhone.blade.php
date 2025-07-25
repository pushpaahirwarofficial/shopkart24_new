@extends('frontend.layouts.main')

@section('main-container')

    <div class="container">
        <!-- enter Phone Number start -->
        <div class="row justify-content-center" id="phoneNumber">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header text-center">{{ __('Login') }}</div>

                    <div class="card-body mt-3">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form id="sendOtpForm" action="{{ route('user.signinSendOtp') }}"  method="POST">
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
                                    <p><a href="{{route('user.register')}}" id="customer_register_link" class="text-center mt-3">Don't have Create account</a></p>
                                    <p><a href="{{route('user.login')}}" id="customer_register_link" class="text-center mt-3" style="margin-left: 0px;">Login Using Email ID</a></p>

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

                        <form id="sendVerifyOtp" action="{{ route('user.phoneVerifyOtp') }}"  method="POST">
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
                                    <div class="invalid-feedback1"></div>
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

<style>

</style>


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
            url: "{{ route('user.signinSendOtp') }}",  // Laravel route
            type: 'POST',  // POST method
            data: formData,  // Send serialized form data
            success: function(response) {
                $('#phone').removeClass('is-invalid');
                $('#phone').next('.invalid-feedback').remove();
                $('#phoneNumber').hide();
                $('#insertOtp').show();
                $('#sendOtpForm')[0].reset();
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
                } else if(xhr.status === 400) {
                        $('#phone').addClass('is-invalid');
                        $('#phone').after('<div class="invalid-feedback">Phone Number Not Registered.</div>');
                    
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
        $('.invalid-feedback1').text('').hide();
        $('input').removeClass('is-invalid');

        // Send the AJAX request
        $.ajax({
            url: form.attr('action'), // Form action URL
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('Login Successfully');
                // window.location.href = "{{ route('checkout') }}"; // Redirect
                window.location.href = "{{ url('profile') }}"; // Redirect

            },
            error: function(xhr) {

                if (xhr.status === 422) {
                    // Validation errors
                    var errors = xhr.responseJSON.errors;
            
                    // Loop through the errors and display them
                    $.each(errors, function(field, messages) {
                        var inputField = $('#' + field);
            
                        // Highlight the invalid field
                        inputField.addClass('is-invalid');
            
                        // Prepare the error message
                        var errorMessageHtml = messages.map(function(message) {
                            return '<p>' + message + '</p>'; // Wrap each message in a paragraph tag
                        }).join('');
            
                        // Display the error messages
                        var feedbackElement = inputField.next('.invalid-feedback');
                        if (feedbackElement.length) {
                            feedbackElement.html(errorMessageHtml).show();
                        } else {
                            inputField.after('<div class="invalid-feedback" style="color:red;">' + errorMessageHtml + '</div>');
                        }
                    });
                } else if (xhr.status === 400) {
                    // Invalid OTP or phone number
                    $('.invalid-feedback').remove(); // Clear existing feedback
                        alert(xhr.responseJSON.message);
                } else {
                    // Other errors
                    alert('Something went wrong. Please try again later.');
                }

            }

        });
    });
});


</script>