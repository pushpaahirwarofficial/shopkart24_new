<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; // Make sure this line is present
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Customer;

class PaymentController extends Controller
{

    public function processPayment(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $order_details = $api->order->fetch($input['razorpay_order_id']);
        try {
            $attributes = [
                'razorpay_order_id' => $input['razorpay_order_id'],
                'razorpay_payment_id' => $input['razorpay_payment_id'],
                'razorpay_signature' => $input['razorpay_signature']
            ];

            $api->utility->verifyPaymentSignature($attributes);
            $order = Order::where('razorpay_order_id', $input['razorpay_order_id'])->first();
    
            if (!$order) {
                $order = new Order();
                $order->razorpay_order_id = $input['razorpay_order_id'];
                $order->user_id = auth()->id(); // Assuming you have authenticated users
            }
    
            $order->razorpay_payment_id = $input['razorpay_payment_id'];
            $order->razorpay_signature = $input['razorpay_signature'];
            $order->status = 'paid';
            $order->amount = $order_details['amount']/100;
            $order->address_id = $input['address_id'];
            $order->order_date = now(); // ✅ Add this line
            $order->payment_status = 'success'; // ✅ Add this line
            $order->save();
    
            $userId = auth()->id();
            $cart = Session::get('cart', []);
    
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }
            
            $user = User::find($userId);   
            //Mail::to($user->email)->send(new OrderPlaced($order));
            Session::forget('cart');
            Cart::where('user_id', $userId)->delete();
            return redirect()->route('payment.success');
        } catch (\Exception $e) {
                // try {
                //     Mail::html('
                //         <h1>Order Cancel bcoz payment failed</h1>
                //         <p>Thank you for trying to  placing your order!</p>
                //         <p>Try again or go cash on delivery.</p>
                //     ', function ($message) use ($user) {
                //         $message->to($user->email)
                //                 ->subject('Payment Failed');
                //     });
                // } catch (\Exception $e) {
                //     return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
                // }

            Log::error('Payment verification failed: ' . $e->getMessage());
            return redirect()->route('payment.failed')->with('error', $e->getMessage());
        }
    }
    
public function processPaymentStripe(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $user = Auth::user();
    $amount = $request->amount * 100; // amount in paisa

    try {

        // Step 1: Create session
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => ['name' => 'Shopkart24 Order'],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment', // ✅ Must be 'payment'
            'success_url' => route('payment.success.stripe') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.failed'),
            'customer_email' => $user->email,
            'metadata' => [
                'user_id' => $user->id,
                'address_id' => $request->address_id,
            ],
        ]);

        // Create a placeholder order with initiated status
        $order = new Order();
        $order->user_id = $user->id;
        $order->amount = $request->amount;
        $order->status = $session->payment_status;
        $order->payment_status = 'initiated';
        $order->stripe_payment_intent_id = $session->id;
        $order->address_id = $request->address_id;
        $order->order_date = now();
        $order->razorpay_order_id = '';
        $order->save();

        // Save cart items
        $cart = Session::get('cart', []);
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        return redirect($session->url); // ✅ Redirects to Stripe payment page

    } catch (\Exception $e) {
        Log::error('Stripe CheckoutSession creation failed: ' . $e->getMessage());
        return back()->with('error', 'Stripe payment failed.');
    }
}

public function paymentSuccessStripe(Request $request)
{
    try {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = \Stripe\Checkout\Session::retrieve([
            'id' => $request->get('session_id'),
            'expand' => ['payment_intent'],
        ]);

        $paymentIntent = $session->payment_intent;

        $order = Order::where('stripe_payment_intent_id', $request->get('session_id'))->first();

        if ($order) {
            $order->status = 'paid';
            $order->payment_status = 'success';
            $order->stripe_payment_intent_id = $paymentIntent->id;
            $order->stripe_client_secret = $paymentIntent->client_secret;
            $order->stripe_payment_method_id = $paymentIntent->payment_method;
            $order->save();

            // Clear cart
            Session::forget('cart');
            Cart::where('user_id', $order->user_id)->delete();
        }

        return view('frontend.payment_success');

    } catch (\Exception $e) {
        Log::error('Stripe success handler failed: ' . $e->getMessage());
        return redirect()->route('payment.failed')->with('error', 'Payment verification failed.');
    }
}


}


