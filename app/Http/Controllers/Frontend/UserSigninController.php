<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Validator;
use DB;
use Illuminate\Support\Facades\Http;
use Log;
use Illuminate\Support\Str;
use App\Models\Wishlist;

class UserSigninController extends Controller
{
    public function indexMobile(){
        if(!empty(Auth::check())) {
        return redirect('/');
        } else {
        return view('frontend.signinPhone');
        }
    }

    public function sendOtp(Request $request)
    {
        if(empty(Auth::check())) {

            // Validate phone number
            $validator = Validator::make($request->all(), [
                'phone' => 'required|regex:/^[0-9]{10}$/', // Phone should be 10 digits
            ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422); // 422 Unprocessable Entity
            }
        
            $otp = rand(100000, 999999); // Generate OTP
            $phone = $request->input('phone'); // Get phone number from request
            
            $userOnData = User::where('phone', $phone)->where('password', '!=', 'temp password')->first();
            if($userOnData) {
            // Attempt to send the OTP to the phone
            $smsSent = $this->sendOtpToPhoneTwilio($phone, $otp);
        
                if ($smsSent) {
                    // Save OTP to the database
                    DB::table('otps')->insert([
                        'phone' => $phone,
                        'otp' => $otp,
                        'created_at' => now(),
                        'expire_at' => now()->addMinutes(5), // Example expiry time
                    ]);
            
                    return response()->json(['message' => 'OTP sent successfully!'], 200); // 200 OK
                } else {
                    return response()->json(['error' => 'Failed to send OTP.'], 500); // 500 Internal Server Error
                }
            
            } else {
                    return response()->json(['error' => 'Phone Number Not Registered.'], 400); // 500 Internal Server Error
            }
        } else {
            return redirect('/');
        }
    }
    
    

public function verifyOtp(Request $request)
{
    if(empty(Auth::check())) {

    // Validate the input
    $validator = Validator::make($request->all(), [
        'phoneOTP' => [
            'required',
            'regex:/^[0-9]{10}$/',
        ],
        'otp' => [
            'required',
            'digits:6',
        ],
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ], 422); // 422 Unprocessable Entity
    }

    $phone = $request->input('phoneOTP');
    $otp = $request->input('otp');

    $otpRecord = DB::table('otps')->where('phone', $phone)->orderBy('created_at', 'desc')->first();

    // Check if OTP exists and matches
    if ($otpRecord && $otpRecord->otp == $otp) {
        $sessionId = Str::uuid()->toString();
        Session::put('user_temp_session_id', $sessionId);
        Session::put('user_phone', $phone);
        Session::put('verified_at', now());

        $user = User::where('phone', $phone)->first();

        Auth::login($user);
        session(['user' => $user]);

        DB::table('otps')->where('phone', $phone)->delete();

        $this->syncSessionCartWithDatabase(auth()->user());

        $this->mergeSessionWishlistWithDatabase(auth()->user());

        if (Auth::check()) {
            return response()->json([
                'status' => 'success',
                // 'redirect_url' => route('profile'), // Return a URL for the frontend to use
                'message' => 'Login successful!',
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Login failed, please try again.',
        ], 401);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Invalid OTP or phone number.',
    ], 400);
    
    } else {
        return redirect()->back();
    }
}

    private function sendOtpToPhoneTwilio($phone, $otp)
    {
        $accountSid = env('TWILIO_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioPhoneNumber = env('TWILIO_PHONE');

        $message = "SHOPCART24 Verification OTP code is: {$otp}";

        $url = "https://api.twilio.com/2010-04-01/Accounts/{$accountSid}/Messages.json";

        $data = [
            'To' => '+91'.$phone,
            'From' => $twilioPhoneNumber,
            'Body' => $message,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_USERPWD, "{$accountSid}:{$authToken}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        \Log::info('Twilio Response: ' . $response);
        
        return $response;

    }



private function syncSessionCartWithDatabase($user)
{
    // Retrieve the cart data from the session
    $cart = Session::get('cart', []);

    // Get the user's existing cart items from the database, keyed by id
    $existingCart = Cart::where('user_id', $user->id)->get()->keyBy('id');

    // Loop through session cart items and prepare for saving
    foreach ($cart as $item) {
        // If the item already exists in DB, remove it
        if (isset($existingCart[$item['id']])) {
            $existingCart[$item['id']]->delete();
        }

        // Create a new cart item instance
        $cartItem = new Cart([
            'user_id' => $user->id,
            'id' => $item['id'],
            'quantity' => $item['quantity']
        ]);

        // Add/replace item in the existing cart collection
        $existingCart[$item['id']] = $cartItem;
    }

    // Save all items to the database
    if (!empty($existingCart)) {
        foreach ($existingCart as $cartItem) {
            $cartItem->save();
        }
    }
}
    

 private function mergeSessionWishlistWithDatabase($user)
{
    $wishlistProductIds = Session::get('wishlist', []);

    // Ensure it's an array
    if (!is_array($wishlistProductIds)) {
        $wishlistProductIds = [$wishlistProductIds];
    }

    foreach ($wishlistProductIds as $productId) {
        // Get categoryId for the product
        $product = DB::table('product')->where('productId', $productId)->first();

        if (!$product) {
            continue; // Skip if product doesn't exist
        }

        $categoryId = $product->categoryId;

        // Check if the product is already in the wishlist
        $existingItem = Wishlist::where('user_id', $user->id)
            ->where('id', $productId)
            ->first();

        if (!$existingItem) {
            // Add to wishlist
            Wishlist::create([
                'user_id'    => $user->id,
                'id' => $productId,
                'categoryId' => $categoryId,
            ]);
        }
        // If it exists, we skip adding duplicate
    }

    // Clear the session wishlist
    Session::forget('wishlist');
}   
    
    
}

