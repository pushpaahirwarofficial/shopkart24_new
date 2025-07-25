<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Product; // Import the Blog model
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; // Make sure this line is present
use App\Models\Cart; // Ensure this line is present
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Address;
use Razorpay\Api\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
public function index()
{
    // Check if there is any cart data in the session
    $cart = Session::get('cart', []);
    $amount = 0;
    $order = null; // Initialize $order variable

    $addresses = Auth::user()->addresses ?? collect();
    
    $coupons = DB::table('coupons')->where('is_active', 0)->get();

    if (Auth::check()) {
        $userId = Auth::id();

        // Retrieve cart details from the database
        $cartItems = Cart::where('user_id', $userId)->get();

        // Merge the database cart items with existing session cart data
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);

            if ($product) {
                $cart[$item->product_id] = [
                    'id' => $item->id,
                    'quantity' => $item->quantity,
                    'product_id' => $item->product_id,
                    'category_id' => $item->categoryId,
                    'user_id' => $item->user_id,
                    'name' => $product->productName,
                    'price' => $product->productPrice,
                    'saleprice' => $product->productSalePrice ?? 0, // Use null coalescing operator
                    'charges' => $product->charges ?? 0, // Use null coalescing operator and default to 0
                    'image' => $product->image ?? '', // Ensure image is set or default to empty string
                ];
            }
        }

        // Update the session with the merged cart data
        Session::put('cart', $cart);
    } else {
        // Ensure charges key is set for session cart items
        foreach ($cart as $productId => $item) {
            $product = Product::find($item['product_id']); // Retrieve the product to get charges
            if ($product) {
                $cart[$productId]['charges'] = $product->charges ?? 0;
            }
        }

        // Update the session with the updated cart data
        Session::put('cart', $cart);
    }

    return view('frontend.cart', compact('addresses', 'cart', 'order', 'amount', 'coupons'));
}


public function add(Request $request)
{
    $productId = $request->input('product_id');
    $product = Product::find($productId);

    if (!$product) {
        return redirect()->back()->with('error', 'Product not found!');
    }

    if (Auth::check()) {
        
            $userId = Auth::id();
            $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();
        
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            $cartItem = new Cart();
            $cartItem->user_id = $userId;
            $cartItem->product_id = $productId;
            $cartItem->categoryId = $product->categoryId;
            $cartItem->quantity = 1;
            $cartItem->save();
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    } else {
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $cart[$productId] = [
                'id' => uniqid(), // Generate a unique ID for the session cart item
                'product_id' => $productId,
                'categoryId' => $product->categoryId,
                'quantity' => 1,
                'name' => $product->productName,
                'price' => $product->productPrice,
                'image' => $product->image ?? '',
            ];
        }
        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }
}


public function update(Request $request, $productId)
{
    $action = $request->input('action');

    if (Auth::check()) {
        
        $userId = Auth::id();
        $cartItem = Cart::where('product_id', $productId)->where('user_id', Auth::id())->first();

        if ($cartItem) {
            if ($action === 'increase') {
                $cartItem->quantity++;
            } elseif ($action === 'decrease' && $cartItem->quantity > 1) {
                $cartItem->quantity--;
            }

            $cartItem->save();
        }

        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $cartItem->quantity;
            Session::put('cart', $cart);
        }
    } else {
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            if ($action === 'increase') {
                $cart[$productId]['quantity']++;
            } elseif ($action === 'decrease' && $cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
            }
            Session::put('cart', $cart);
        }
    }

    return redirect()->route('cart.index')->with('success', 'Cart updated successfully');
}



public function destroy($productId)
{
    if (Auth::check()) {
        $user = Auth::user();
        $user->carts()->where('product_id', $productId)->delete();
    } else {
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }
    }

    // Fetch the updated cart data
    $cart = Auth::check() ? Auth::user()->carts()->get() : Session::get('cart', []);

    return redirect()->route('cart.index')->with(['success' => 'Product removed from cart', 'cart' => $cart]);
}

public function checkout(Request $request)
{
    $cartAvail = DB::table('carts')->where('user_id', Auth::id())->first();
    if(!empty($cartAvail)) {
        // Check if there is any cart data in the session
        $cart = Session::get('cart', []);
        $amount = 0;
        
        if (Auth::check()) {
            $userId = Auth::id();
            $userData = User::find($userId);
            
            // Retrieve cart details from the database
            $cartItems = Cart::where('user_id', $userId)->get();
    
            // Merge the database cart items with existing session cart data
            foreach ($cartItems as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $cart[$item->product_id] = [
                        'id' => $item->id, // Include the cart item ID here
                        'quantity' => $item->quantity,
                        'product_id' => $item->product_id,
                        'category_id' => $item->category_id,
                        'user_id' => $item->user_id,
                        'name' => $product->productName,
                        'price' => $product->productPrice,
                        'image' => $product->image ?? '', // Ensure image is set or default to empty string
                    ];
                }
            }
    
            // Update the session with the merged cart data
            Session::put('cart', $cart);
        }
        return view('frontend.checkout', compact('cart', 'userId', 'userData'));
    } else {
       return redirect()->route('home');
    }
}


public function showAddressForm(Request $request)
{
    
    // Check if there is any cart data in the session
    $cart = Session::get('cart', []);
    $amount = 0;
    $order = null; // Initialize $order variable
    $address_id = $request->address_id;

    $discountAmoutPrice = $request->discountAmoutPrice;
    Session::put('discountAmoutPrice', $discountAmoutPrice);
    
    if (Auth::check()) {
        $userId = Auth::id();

        // Retrieve cart details from the database
        $cartItems = Cart::where('user_id', $userId)->get();

        // Merge the database cart items with existing session cart data
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $cart[$item->product_id] = [
                    'id' => $item->id, // Include the cart item ID here
                    'quantity' => $item->quantity,
                    'product_id' => $item->product_id,
                    'categoryId' => $item->category_id,
                    'user_id' => $item->user_id,
                    'name' => $product->productName,
                    'price' => $product->productPrice,
                    'image' => $product->image ?? '', // Ensure image is set or default to empty string
                ];
            }
        }

        // Update the session with the merged cart data
        Session::put('cart', $cart);
    }
}

// cashOnDelivery Start

    public function storeAddress(Request $request)
    {
        // Base validation rules
        $rules = [
            '_token' => 'required|string',
            'country' => 'required|string|in:india',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'billing_city' => 'required|string|max:255',
            'billing_state_1' => 'required|string|not_in:Select',
            'billing_pin' => 'required|digits:6',
            'phone' => 'required|regex:/^\d{10}$/',
            'payment_type' => 'required|in:online,cod',
            'payment_method' => 'required|string',
            'billing_address_select' => 'required|in:shipping,billing',
        ];
    
        // Additional rules if "billing" is selected
        if ($request->billing_address_select === "billing") {
            $rules = array_merge($rules, [
                'billing_first_name' => 'required|string|max:255',
                'billing_last_name' => 'required|string|max:255',
                'billing_address_11' => 'required|string|max:255',
                'billing_apartment_11' => 'nullable|string|max:255',
                'billing_state_11' => 'required|string|max:255',
                'billing_phone_11' => 'nullable|regex:/^\d{10}$/',
                'billing_pin_11' => 'required|digits:6',
            ]);
        }
    
        // Validate the request
        $request->validate($rules, [
            // Define custom messages here as needed
            '_token.required' => 'Session token is missing. Please refresh the page and try again.',
            // Add specific error messages for billing fields here
        ]);
    
            $address = Address::create([
                'user_id' => Auth::id(),
                'fname' => $request->first_name,
                'lname' => $request->last_name,
                'pincode' => $request->billing_pin,
                'flat' => $request->apartment,
                'area' => $request->address,
                'landmark' => $request->address, // Or provide a separate field for landmark
                'town_city' => $request->billing_city,
                'state' => $request->billing_state_1,
                'number' => $request->phone,
                'country' => $request->country,
                'address_type' => "shipping",
            ]);

    
        // Save billing address
        if ($request->billing_address_select === "billing") {
            $address = Address::create([
                'user_id' => Auth::id(),
                'fname' => $request->billing_first_name,
                'lname' => $request->billing_last_name,
                'pincode' => $request->billing_pin_11,
                'flat' => $request->billing_apartment_11,
                'area' => $request->billing_address_11,
                'landmark' => $request->billing_address_11, // Or provide a separate field for landmark
                'town_city' => $request->billing_city_11,
                'state' => $request->billing_state_11,
                'country' => $request->billing_country_11,
                'number' => $request->billing_phone_11,
                'address_type' => "billing",
            ]);
        }
        
        $userid = Auth::id();
        $addressId = Address::where('user_id', $userid)->latest()->first()->id;
        $temp_user = User::where('password', 'temp password')->where('id', $userid)->first();
        
        if ($request->payment_type == 'cod') {
            $paymentType = $request->payment_type;
            $this->cashOnDelivery($userid, $paymentType, $addressId);
            Session::forget('cart');
            if($temp_user) {
                // $temp_user_delete = User::where('password', 'temp password')->where('id', $userid)->delete();
                Session::flush(); // Optionally clear the entire session
            }    
            return redirect()->route('cod.success');       
        } else {
            // Redirect to the payment page with the address ID
            return redirect()->route('razorpay.payment', ['address_id' => $addressId]);
        }
    }

// cashOnDelivery End

    public function showPaymentForm()
    {
        // Ensure the address is provided
        if (!session()->has('selected_address')) {
            return redirect()->route('checkout.address');
        }
    }


    public function selectAddress(Request $request)
    {
        // Store the selected address in the session
        $address = Auth::user()->addresses()->findOrFail($request->address_id);
        session(['selected_address' => $address]);

        // Redirect to the payment page
        return redirect()->route('checkout.payment');
    }

// online payment start

public function payment(Request $request)
{
   $order = null; // Initialize $order variable
   $addressId = $request->query('address_id'); // gets ?address_id=304

    if ($request->user()) {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $userId = Auth::id();
        // Retrieve the actual amount from your application logic
        $amount = $this->getOrderAmount($userId); // Implement this method to get the actual order amount

        $order = $api->order->create([
            'receipt' => 'order_' . $request->user()->id . '_' . time(),
            'amount' => $amount, // amount in paisa
            'currency' => 'INR',
        ]);

    } else {
        return redirect()->route('user.login');
    }
    return view('frontend.payment', ['order' => $order, 'amount' => $amount, 'addressId' => $addressId]);
}

// online payment end


    private function getOrderAmount($userId)
    {
        // Retrieve the cart items for the given user along with the product details
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        
        $subtotal = 0;
    
        foreach ($cartItems as $item) {
            $total = $item->product->productPrice * $item->quantity; // Assuming productPrice is the price field in products table
            $subtotal += $total;
        }
        
        // Apply delivery charges based on subtotal
        if ($subtotal < 500) {
            $deliveryCharges = 60;
        } else {
            $deliveryCharges = 0;
        }
            
            // Retrieve discount amount from the session, defaulting to 0
            $discountAmoutPrice = Session::get('discountAmoutPrice', 0);
            
            // Ensure all amounts are treated as integers for the calculation
            $subtotal = (int)$subtotal;          // Convert subtotal to integer
            $deliveryCharges = (int)$deliveryCharges;  // Convert delivery charges to integer
            $discountAmoutPrice = (int)$discountAmoutPrice;  // Convert discount amount to integer
            
            // Calculate the final total as an integer
            $finalTotal = $subtotal + $deliveryCharges - $discountAmoutPrice;
            
            // Optionally, ensure final total is also an integer (though it should already be)
            $finalTotal = (int)$finalTotal;
    
            // Convert the final total to paisa
            return $finalTotal * 100; // Assuming finalTotal is in rupees
    }

    
    public function applyCoupon(Request $request) {
        $couponCode = $request->input('coupon_code');
        $coupon = DB::table('coupons')
            ->where('id', $couponCode)
            ->where('expires_at', '>', now()) // Compare expire_at with current time
            ->first();
        if ($coupon) {
            return response()->json(['success' => true, 'new_amount' => $coupon]);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid coupon code']);
        }
    }

    public function applyCouponVerify(Request $request) {
        // Validate the incoming data
        $validated = $request->validate([
            // 'coupon_code' => 'required|string',
            'categories' => 'required',
        ]);
    
        $couponCode = $request->coupon_code;
        
        $categories = array_map('intval', json_decode($request->categories, true));
    
        if(!empty($couponCode)) {
            $coupon = DB::table('coupons')
                ->where('code', $couponCode) 
                ->whereIn('product_code', $categories) 
                ->where('expires_at', '>', now())
                ->first();
                
            $cat_name = DB::table('category')->where('categoryId', $coupon->product_code)->first();
            if($coupon->discount_type == 'percent') {
                $suffix = '%';    
            } else {
                $suffix = '.00';
            }
                
            if ($coupon) {
                $newAmount = $this->applyCouponDiscount($coupon, $request->totalPrice);
                Session::put('new_amount', $newAmount);
                return response()->json([
                    'success' => true,
                    'new_amount' => $newAmount, 
                    'coupon' => $coupon,
                    'cat_name' => $cat_name->categoryName,
                    'suffix' => $suffix,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid coupon code or no applicable categories.',
                ]);
            }
        } else {
               $newAmount = $request->totalPrice;
                Session::put('new_amount', $newAmount);
        }
    }
    
    
        
    private function applyCouponDiscount($coupon, $totalPrice)
    {
        // Get the original amount from the session or use $totalPrice if the session value is not set
        $originalAmount = session('total_amount', $totalPrice);
    
        // Calculate the discounted amount based on the coupon type
        if ($coupon->discount_type == 'percent') {
            $discountedAmount = round($originalAmount - ($originalAmount * ($coupon->discount_amount / 100)), 2);
        } else {
            $discountedAmount = $originalAmount - $coupon->discount_amount;
        }
    
        // Ensure the discounted amount is not negative
        $discountedAmount = max(0, $discountedAmount);
    
        // Store the discounted amount in the session
        session(['discounted_amount' => $discountedAmount]);
    
        return $discountedAmount;
    }
    
    
    
    private function cashOnDelivery($userid, $paymentType, $addressId)
    {
            $cartItems = Cart::where('user_id', $userid)->get();
    
            // Initialize cart data array
            $cart = [];
    
            foreach ($cartItems as $item) {
                $product = Product::find($item->product_id);
    
                if ($product) {
                    $cart[] = [
                        'id' => $item->id,
                        'quantity' => $item->quantity,
                        'product_id' => $item->product_id,
                        'category_id' => $item->categoryId,
                        'user_id' => $item->user_id,
                        'name' => $product->productName,
                        'price' => $product->productPrice,
                        'saleprice' => $product->productSalePrice ?? 0,
                        'charges' => $product->charges ?? 0,
                        'image' => $product->image ?? '',
                    ];
                }
            }
    
    
            // Check if the 'new_amount' session key exists
            if (Session::has('new_amount')) {
                // If the session has 'new_amount', use it
                $totalAmount = Session::get('new_amount');
            } else {
                // If 'new_amount' is not in the session, calculate it from the cart
                $totalAmount = collect($cart)->sum(function ($item) {
                    return ($item['saleprice'] ?: $item['price']) * $item['quantity'];
                });
            
                // Optionally, add an additional charge (e.g., shipping fee)
                $totalAmount += 60;
            }
            
            $userSingle = User::where('id', $userid)->first();
            
            if($userSingle->password=='temp password') {
                $user_type = 'guest';
            } else {
                $user_type = 'permanent';
            }

            // Create the order using DB Facade
            $order = DB::table('orders')->insertGetId([
                'user_id' => $userid,
                'user_type' => $user_type,
                'address_id' => $addressId,
                'status' => $paymentType,
                'payment_status' => 'pending',
                'amount' => $totalAmount,
                'razorpay_order_id' => "",
                'order_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            // Insert order items using DB Facade
            foreach ($cart as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $order, // Use the order ID returned from insertGetId
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['saleprice'] ?: $item['price'], // Use sale price if available
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
    
        Session::forget('cart');
        DB::table('carts')->where('user_id', $userid)->delete();
        $userData = DB::table('users')->where('id', $userid)->first();
    
        if($userData->password != 'temp password') {
        //          Mail::html('
        //     <table style="width: 100%; font-family: Arial, sans-serif; border-collapse: collapse; background-color: #f9f9f9; padding: 20px;">
        //         <tr>
        //             <td style="padding: 20px; text-align: center; background-color: #4CAF50; color: white;">
        //                 <h1 style="margin: 0;">Order Confirmed! ✅</h1>
        //             </td>
        //         </tr>
        //         <tr>
        //             <td style="padding: 20px;">
        //                 <h2 style="color: #333;">Hi [Customer Name],</h2>
        //                 <p style="font-size: 16px; line-height: 1.5; color: #555;">
        //                     Thank you for placing your order with us! 🎉 We’ve successfully received your Cash on Delivery order.
        //                 </p>
        //                 <p style="font-size: 16px; line-height: 1.5; color: #555;">
        //                     Your order details:
        //                 </p>
        //                 <table style="width: 100%; margin: 20px 0; border: 1px solid #ddd; text-align: left;">
        //                     <tr style="background-color: #f2f2f2;">
        //                         <th style="padding: 10px; border-bottom: 1px solid #ddd;">Item</th>
        //                         <th style="padding: 10px; border-bottom: 1px solid #ddd;">Quantity</th>
        //                         <th style="padding: 10px; border-bottom: 1px solid #ddd;">Price</th>
        //                     </tr>
        //                     <!-- Example Row -->
        //                     <tr>
        //                         <td style="padding: 10px; border-bottom: 1px solid #ddd;">Product Name</td>
        //                         <td style="padding: 10px; border-bottom: 1px solid #ddd;">1</td>
        //                         <td style="padding: 10px; border-bottom: 1px solid #ddd;">$99.99</td>
        //                     </tr>
        //                 </table>
        //                 <p style="font-size: 16px; line-height: 1.5; color: #555;">
        //                     Your order will be delivered to the address you provided. Please ensure someone is available to accept the delivery and provide the payment in cash.
        //                 </p>
        //                 <p style="font-size: 16px; line-height: 1.5; color: #555;">
        //                     If you have any questions, feel free to contact our support team at <a href="mailto:support@example.com" style="color: #4CAF50;">support@example.com</a>.
        //                 </p>
        //             </td>
        //         </tr>
        //         <tr>
        //             <td style="padding: 20px; text-align: center; background-color: #f2f2f2;">
        //                 <a href="https://yourwebsite.com/track-order" style="display: inline-block; padding: 10px 20px; font-size: 16px; color: white; background-color: #4CAF50; text-decoration: none; border-radius: 5px;">Track Your Order</a>
        //             </td>
        //         </tr>
        //     </table>
    
        // ', function ($message) use ($userData) {
        //   $message->to($userData->email)
        //   ->subject('Cash on delivery');
        //   });
   
        }
            return $order; // Return the order ID if needed
    }

    
    public function couponDestroy()
    {
        Session::forget('new_amount');
        return back()->with('success', 'Coupon removed successfully');
    }

    private function sendSms1($mobileNumber, $message, $country)
    {
        $authKey = env('MSG91_AUTH_KEY'); // Auth Key
        $senderId = env('MSG91_SENDER_ID'); // Sender ID
        $route = 4; // Route 4: Transactional SMS

        $response = Http::asForm()->post('https://api.msg91.com/api/v2/sendsms', [
            'authkey' => $authKey,
            'sender'  => $senderId,
            'route'   => $route,
            'country' => $country,
            'mobile'  => $mobileNumber,
            'message' => $message,
        ]);


        return $response->json();
    }


}
