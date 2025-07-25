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
    
}
