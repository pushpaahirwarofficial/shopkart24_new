@extends('frontend.layouts.main')

@section('main-container')
  <h1>Wishlist</h1>
   @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($wishlistItems->isEmpty())
        <p>Your wishlist is empty.</p>
    @else
        <div class="row">
      @foreach ($wishlistItems as $item)

<?php
$string = $item->product->image;
$result = explode('|', $string); 
?>


    <div class="col-md-3 m-4">
        <div class="card">
            <img src="{{ asset('image/' . $result[0]) }}" class="card-img-top" alt="{{ $item->product->productName }}">
            <div class="card-body">
                <h5 class="card-title">{{ $item->product->productName }}</h5>
                <p class="card-text">Price: ${{ $item->product->productPrice }}</p>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $item->product->productId }}">
                    <button type="submit" class="btn" style="width: -webkit-fill-available; background: black; color:white;">Add To Cart</button>
                </form>
                <form action="{{ route('wishlist.remove', ['id' => $item->product->productId]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="btn mt-2" style="width: -webkit-fill-available; background: white; color: black;" data-product-id="{{ $item->product->productId }}">Remove</button>
    </form>
    
     <script>
        document.addEventListener("DOMContentLoaded", function() {
            updateButtonColor("{{ $item->product->productId }}", true);
        });
    </script>
            </div>
        </div>
    </div>
@endforeach



        </div>
    @endif
  @endsection