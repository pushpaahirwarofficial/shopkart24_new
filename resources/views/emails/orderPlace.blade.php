@component('mail::message')
# Order Confirmation

Thank you for your order, {{ $order->customer_name }}! Your order has been successfully placed.

**Order Number:** {{ $order->order_number }}

## Order Details:

| Product Name        | Quantity | Price   |
| ------------------- | -------- | ------- |
@foreach($order->orderItems as $item)
| {{ $item->product->name }} | {{ $item->quantity }} | ${{ number_format($item->price, 2) }} |
@endforeach

**Total Price:** ${{ number_format($order->total_price, 2) }}

## Shipping Information:

**Shipping Address:**  
{{ $order->shipping_address }}

Thank you for shopping with us!

@component('mail::button', ['url' => route('order.details', $order->id)])
View Your Order
@endcomponent

@component('mail::panel')
If you have any questions or need assistance, feel free to contact our support team.
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent
