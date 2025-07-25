@extends('frontend.layouts.main')

@section('main-container')

<style> #shopify-section-header .megamenu {line-height: 1;} #shopify-section-header .megamenu a {font-size: 0.9em;} #shopify-section-header .site-nav__dropdown-link--second-level {font-size: 0.9em;} #shopify-section-header .h5 a {color: #ec688d;} #shopify-section-header .mobile-nav .appear-delay-2 a {color: #ec688d;} #shopify-section-header .mobile-nav .appear-delay-3 a {color: #9b006f;} </style></div><main class="main-content" id="MainContent">
    
<div class="page-width page-width--tiny page-content" id="regForm">
    
    <header class="section-header">
    <h1 class="section-header__title text-center " style="color: #ec688d!important;">Register</h1>
    </header>

    <form id="registerForm" method="POST" action="{{ route('store.register') }}">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="input-full">
        <div class="invalid-feedback" id="name-error" style="color: red;"></div>
    
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="input-full">
        <div class="invalid-feedback" id="email-error" style="color: red;"></div>
    
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="input-full">
        <div class="invalid-feedback" id="phone-error" style="color: red;"></div>
    
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="input-full">
        <div class="invalid-feedback" id="password-error" style="color: red;"></div>
    
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="input-full">
        <div class="invalid-feedback" id="password_confirmation-error" style="color: red;"></div>
    
        <button type="button" id="submitForm" class="btn btn--full" style="background: #ec688d; color: white; margin-top: 20px;">Register</button>
    </form>
                                    <!--<p><a href="{{route('user.register')}}" id="customer_register_link" class="text-center mt-3">Don't have Create account</a></p>-->
<p><a href="{{route('user.signinPhone')}}" id="customer_register_link" class="text-center mt-4" style="margin-left: 0px;">Already have Account So Go for Login</a></p>
</div>

    <div class="container">
        <!-- enter Phone Number start -->
        <!--<div class="row justify-content-center" id="phoneNumber" style="display:none;">-->
        <!--    <div class="col-md-8">-->
        <!--        <div class="card mt-5">-->
        <!--            <div class="card-header text-center">{{ __('Registration OTP Verification') }}</div>-->

        <!--            <div class="card-body mt-3">-->
        <!--                @if (session('status'))-->
        <!--                    <div class="alert alert-success" role="alert">-->
        <!--                        {{ session('status') }}-->
        <!--                    </div>-->
        <!--                @endif-->

        <!--                <form id="sendOtpForm" action="{{ route('user.register.sendOtp') }}"  method="POST">-->
        <!--                    @csrf-->
        <!--                    <div class="form-group row">-->
        <!--                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>-->

        <!--                        <div class="col-md-6">-->
        <!--                            <input id="phone" type="text" name="phone1" value="{{ old('phone') }}" autocomplete="phone" autofocus>-->
                                        <!-- Error message container for phone -->
        <!--                                <div class="invalid-feedback"></div>-->
        <!--                        </div>-->
        <!--                    </div>-->

        <!--                    <div class="form-group row mb-0">-->
        <!--                        <div class="col-md-6 offset-md-4">-->
        <!--                            <button type="submit" class="btn" style="background:#e46d8e; color:white;">-->
        <!--                                {{ __('Send OTP') }}-->
        <!--                            </button>-->
        <!--                            <a href="javascript:void(0)" id="backLink_1" style="">Back</a>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </form>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
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

                        <form id="sendVerifyOtp" action="{{ route('user.register.verifyOtp') }}"  method="POST">
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
                                    <a href="javascript:void(0)" id="backLink_2" style="">Back</a>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

$(document).ready(function() {
    $('#backLink_2').click(function(e) {
        e.preventDefault();
        $('#regForm').show();
    });
});

// $(document).ready(function() {
//     $('#backLink_2').click(function(e) {
//         e.preventDefault();
//         $('#sendOtpForm').show();
//     });
// });


$(document).ready(function() {
    $('#submitForm').click(function(e) {
        e.preventDefault();

        // Clear previous errors
        $('.invalid-feedback').text('');
        $('.input-full').removeClass('is-invalid');

        // Prepare the form data
        var formData = {
            name: $('#name').val(),
            email: $('#email').val(),
            phone: $('#phone').val(),
            password: $('#password').val(),
            password_confirmation: $('#password_confirmation').val(),
            _token: $('input[name="_token"]').val()
        };

        // AJAX call
        $.ajax({
            url: "{{ route('store.register') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                if (response.success === true) {
                    $('#regForm').fadeOut();
                    $('#insertOtp').fadeIn();

                    // alert(response.message); // Success message
                    // window.location.href = response.redirect_url; // Redirect
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;

                    // Display errors dynamically
                    $.each(errors, function(field, messages) {
                        $('#' + field).addClass('is-invalid'); // Add invalid class to input
                        $('#' + field + '-error').text(messages.join(' ')); // Show all error messages
                    });
                } else {
                    alert('An unexpected error occurred. Please try again.');
                }
            }
        });
    });
});

$(document).ready(function() {
    
    $('#phone').on('input', function() {
        // Get the value from #phone and set it to #phoneOtp
        $('#phoneOTP').val($(this).val());
    });
    
    
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
                alert('Register Successfully');
                // window.location.href = "{{ route('checkout') }}"; // Redirect
                window.location.href = "{{ route('user.signinPhone') }}"; // Redirect
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





