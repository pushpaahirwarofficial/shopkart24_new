@extends('frontend.layouts.main')

@section('main-container')

    <h1 class="text-center mt-5">Payment Successful</h1>
    <p class="text-center">Thank you for your payment. Your transaction was successful.</p>
    <p class="text-center"><a href="{{ route('orders.index') }}">Go To View My Orders</a></p>

    @endsection
