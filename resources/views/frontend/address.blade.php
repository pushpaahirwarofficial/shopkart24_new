

@extends('frontend.layouts.main')

@section('main-container')

<style>
    .razorpay-payment-button{
       background-color: #ec688d;
       color:white;
       border: 0px;
       color : white;
           margin-top: 15px;

    }
</style>
<div class="container px-4 py-4 mb-2 mt-5" style="background-color: white;">
    <div class="row">
        <div class="col-md-12">
             @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
<h1>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</h1>
            @if(!empty($order))
            <form id="paymentForm" action="{{ route('payment') }}" method="POST">
                @csrf
                <script src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="{{ env('RAZORPAY_KEY') }}"
                        data-amount="{{ $order->amount }}"
                        data-currency="INR"
                        data-order_id="{{ $order->id }}"
                        data-buttontext=" Proceed to Checkout"
                        data-name="Shopkart24"
                        data-description="Order payment"
                        data-image="https://shopkart24.com/frontend/img/Logo.png"
                        data-prefill.name="{{ Auth::user()->name }}"
                        data-prefill.email="{{ Auth::user()->email }}"
                        data-theme.color=" #F37254"
                        style= " background-color: #ec688d;;border: 0px;"
                        id="new"
                ></script>
                <input type="hidden" class="" style="background:#ec688d; color:black;" custom="Hidden Element" name="hidden">
                <!--<button class="btn btn-sm btn-primary mt-3" style="background-color: #977935;border: 0px;">Select Address And  Checkout</button>-->
            </form>
        @endif
        
    </div>
</div>
            
        </div>
    </div>
</div>



@endsection