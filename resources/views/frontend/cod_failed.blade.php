@extends('frontend.layouts.main')

@section('main-container')

   <h1 class="text-center mt-5">Order Unsuccessful</h1>
   <p class="text-center">Unfortunately, your order could not be processed. Please try again.</p>
   <p class="text-center"><a href="{{ route('home') }}">Go To Order Again</a></p>

@endsection
