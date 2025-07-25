@extends('frontend.layouts.main')

@section('main-container')

<div class="container d-flex justify-content-center align-items-center">
    <div class="text-center">
        <h2 class="text-center">Complete Your Payment</h2><br><br>
        <form action="{{ route('payment') }}" method="POST">
            @csrf
            <input type="text" name="address_id" value="{{ $addressId }}" required>
            <script src="https://checkout.razorpay.com/v1/checkout.js"
                    data-key="{{ env('RAZORPAY_KEY') }}"
                    data-amount="{{ $order->amount }}"
                    data-currency="INR"
                    data-order_id="{{ $order->id }}"
                    data-buttontext="Pay with Razorpay"
                    data-name="Shopkart24"
                    data-description="Order payment"
                    data-image="https://shopkart24.com/frontend/img/Logo.png"
                    data-prefill.name="{{ Auth::user()->name }}"
                    data-prefill.email="{{ Auth::user()->email }}"
                    data-theme.color="#F37254"
            ></script>
            <input type="hidden" custom="Hidden Element" name="hidden">
        </form>
    </div>
</div>
@endsection

