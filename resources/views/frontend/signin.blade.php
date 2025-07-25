@extends('frontend.layouts.main')

@section('main-container')

<style> #shopify-section-header .megamenu {line-height: 1;} #shopify-section-header .megamenu a {font-size: 0.9em;} #shopify-section-header .site-nav__dropdown-link--second-level {font-size: 0.9em;} #shopify-section-header .h5 a {color: #ec688d;} #shopify-section-header .mobile-nav .appear-delay-2 a {color: #ec688d;} #shopify-section-header .mobile-nav .appear-delay-3 a {color: #9b006f;} </style></div><main class="main-content" id="MainContent">
    <div class="page-width page-width--tiny page-content">
        <style> 
.section-header__title h1
{
text-transform: uppercase!important;
}
.page-container h1 
{
color: #ec688d!important;
} 
</style>
<header class="section-header">
<h1 class="section-header__title text-center" style="color:#ec688d;">Login</h1>
</header>
@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
<div class="note note--success hide" id="ResetSuccess">
We&#39;ve sent you an email with a link to update your password.
</div>
<form method="POST" action="{{ route('store.login') }}">
@csrf

<label for="CustomerEmail">Email</label>
<input type="email" name="email" id="CustomerEmail" class="input-full" autocorrect="off" autocapitalize="off" autofocus><div class="grid">
    @error('email')
        <div>{{ $message }}</div>
    @enderror
    <div class="grid__item one-half">
      <label for="CustomerPassword">Password</label>
    </div>
         <div class="grid__item one-half text-right">
                <small class="label-info">
                    <a href="{{ route('password.request') }}" id="RecoverPassword">
                        Forgot password?
                    </a>
                </small>
        </div>
  </div>
  <input type="password" value="" name="password" id="CustomerPassword" class="input-full"><p>
      @error('password')
        <div>{{ $message }}</div>
    @enderror

  <button type="submit" class="btn btn--full mt-4" style="background: #ec688d;
    color: white;">
    Sign In
  </button>
</p>
<p><a href="{{route('user.register')}}" id="customer_register_link" class="text-center mb-3 pb-3" style="margin-left: 84px;">Don't have Create account</a></p>
<p><a href="{{route('user.signinPhone')}}" id="customer_register_link" class="text-center mb-3 pb-3" style="margin-left: 84px;">Login Using Mobile Number</a></p>
<input type="hidden" name="return_url" value="/account" />
<!--<p><a href="" id="customer_register_link_otp" class="text-center mb-3 pb-3" style="margin-left: 84px;">Login Using Mobile Number</a></p>-->
</div>

</form>


@endsection