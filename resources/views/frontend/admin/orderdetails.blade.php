@extends('frontend.layouts.dashboard')

@section('title', 'Order Details')

@section('content')
<h1>Order Details</h1>

<div class="card">
    <div class="card-body">
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Customer Name:</strong> {{ $order->user->name }}</p>
        <p><strong>Total Quantity:</strong> {{ $order->orderItems->sum('quantity') }}</p>
        <p><strong>Total Price:</strong> ₹{{ number_format($order->amount, 2) }}</p>
        <p><strong>Order Date:</strong> {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

        <h3>Order Items:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Price (Each)</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                  @php
            // Split the image string by '|'
            $images = explode('|', optional($item->product)->image);
            // Get the first image
            $firstImage = $images[0] ?? 'default.jpg'; // Use a default image if none is available
        @endphp
                <tr>
                     <td><img src="{{ asset('image/' . $firstImage) }}" alt="{{ optional($item->product)->productName }}" style="height: 100px; width: 100px;"></td>
                    <td>{{ optional($item->product)->productName ?? 'N/A' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ number_format($item->price, 2) }}</td>
                    <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <br>
        <br>
        
        <h3>Address Details:</h3>
        @if($order->address)
        <p><strong>Address Line 1:</strong> {{ $order->address->flat }}, {{ $order->address->area }}</p>
        <p><strong>Address Line 2:</strong> {{ $order->address->landmark }}</p>
        <p><strong>City:</strong> {{ $order->address->town_city }}</p>
        <p><strong>State:</strong> {{ $order->address->state }}</p>
        <p><strong>Postal Code:</strong> {{ $order->address->pincode }}</p>
        <p><strong>Phone No. :</strong> {{ $order->address->number }}</p>
        @else
        <p>No address details available</p>
        @endif

    </div>
</div>
@endsection
