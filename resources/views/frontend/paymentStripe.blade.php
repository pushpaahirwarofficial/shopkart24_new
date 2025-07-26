@extends('frontend.layouts.main')

@section('main-container')
<div class="container d-flex justify-content-center align-items-center">
    <div class="text-center">
        <h2>Complete Your Payment with Stripe</h2><br><br>

        <form action="{{ route('stripe.payment') }}" method="POST" onsubmit="disableStripeButton(this)">
            @csrf
            <input type="hidden" name="amount" value="{{ $amount }}">
            <input type="hidden" name="address_id" value="{{ $addressId }}">
            <button type="submit" class="btn" style="background-color:#e83e8c; color:white;">Pay with Stripe</button>
        </form>
    </div>
</div>


<script>
function disableStripeButton(form) {
    const button = form.querySelector('button[type="submit"]');
    button.disabled = true;
    button.innerText = 'Processing...'; // Optional feedback text
}
</script>

@endsection
