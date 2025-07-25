<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Wishlist;
use Validator;
use DB;
use Illuminate\Support\Facades\Http;
use Log;
use Illuminate\Support\Str;

class SigninController extends Controller
{
    public function index(){
        return view('frontend.signin');
    }
    public function register(){
        return view('frontend.register');
    }
   
   
   
   
   
public function handleRegister(Request $request)
{
    
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed',
        'phone' => 'required|numeric|digits:10',
    ]);
    
    session()->put('form_data', $data);
    
        $otp = rand(100000, 999999); 

        $smsSent = $this->sendOtpToPhoneTwilio($request->phone, $otp);
         $smsSent = 1;
    
        if ($smsSent) {
            DB::table('otps')->insert([
                'phone' => $request->phone,
                'otp' => $otp,
                'created_at' => now(),
                'expire_at' => now()->addMinutes(5), // Example expiry tim
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Form data stored in session successfully!',
        ]);
        
}

    public function registerVerifyOtp(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'otp' => 'required|digits:6',       
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity
        }
    
        $phone = $request->input('phoneOTP');
        $otp = $request->input('otp');
    
        $otpRecord = DB::table('otps')->where('phone', $phone)->orderBy('created_at', 'desc')->first();
    
            // Check if OTP exists and matches
            if ($otpRecord && $otpRecord->otp == $otp) {
                
                $data = session()->get('form_data');
                
                if ($data) {
                    $user = User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),
                        'phone' => $data['phone'],
                    ]);
                }
                    session()->forget('form_data');    
            // Auth::login($user);
            // session(['user' => $user]);
            return redirect()->route('user.signinPhone')->with('success', 'Registration successful!');

            }
    
            return response()->json(['error' => 'Invalid OTP or phone number.'], 400); // 400 Bad Request

    }



    
public function handleLogin(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);
    
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();

        // Store user data in session
        $user = Auth::user();
        session(['user' => $user]);

        $this->mergeSessionCartWithDatabase(auth()->user());

        $this->mergeSessionWishlistWithDatabase(auth()->user());

        return redirect()->intended('/')->with('success', 'Login successful!');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
}


 public function show()
    {
        $user = Auth::user();
        return view('frontend.profile', compact('user'));
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logout successful!');
    }
    
    
    public function indexMobile(){
        return view('frontend.signinTemp');
    }    
    
    public function sendOtp(Request $request)
    {
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
    }

    
    
    private function sendOtpToPhone($phone, $otp)
    {
        try {
            // Get MSG91 credentials from .env file
            $authKey = env('MSG91_AUTH_KEY');
            $senderId = env('MSG91_SENDER_ID');
            $route = env('MSG91_ROUTE', '4'); // Default to transactional route
            $countryCode = env('MSG91_COUNTRY', '91'); // Default to India (+91)
    
            // Make the API request to MSG91
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://api.msg91.com/api/v5/sms', [
                'authkey' => $authKey,
                'sender'  => $senderId,
                'route'   => $route,
                'country' => $countryCode,
                'mobiles' => $phone, // Use dynamic phone number
                'message' => "For Mobile Verification Your OTP is [ $otp ]. Please enter OTP. Thank you!",
            ]);
    
            // Log the entire response for debugging
            Log::info('MSG91 API Response', ['response' => $response->body()]);
    
            if ($response->successful()) {
                // Save OTP to session or database if needed
                session(['otp' => $otp]); // Optional: Store OTP in session
    
                return true; // Return `true` if SMS sent successfully
            }
    
            // Log failure details
            Log::error('Failed to send SMS', [
                'phone' => $phone,
                'otp' => $otp,
                'response' => $response->json(),
            ]);
    
            return false; // Return `false` if SMS sending fails
        } catch (\Exception $e) {
            // Log exception details
            Log::error('Exception while sending SMS', [
                'message' => $e->getMessage(),
                'phone' => $phone,
                'otp' => $otp,
                'trace' => $e->getTraceAsString(),
            ]);
    
            return false; // Return `false` if SMS sending fails
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






    public function verifyOtp(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'phoneOTP' => 'required|regex:/^[0-9]{10}$/', // Phone should be 10 digits
            'otp' => 'required|digits:6',             // OTP should be 6 digits
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity
        }
    
        $phone = $request->input('phoneOTP');
        $otp = $request->input('otp');
    
            $otpRecord = DB::table('otps')->where('phone', $phone)->orderBy('created_at', 'desc')->first();
    
            // Check if OTP exists and matches
            if ($otpRecord && $otpRecord->otp == $otp) {
                
                $sessionId = Str::uuid()->toString();
                Session::put('user_temp_session_id', $sessionId); // Store the unique session ID

                Session::put('user_phone', $phone);
                Session::put('verified_at', now());
                
                $user = User::updateOrCreate(
                    ['phone' => $phone, 'password' => 'temp password'],
                    [
                        'name' => 'temp name',
                        'email' => $sessionId, 
                    ]
                );

                Auth::login($user);
                session(['user' => $user]);

                DB::table('otps')->where('phone', $phone)->delete();
                
                $cart = Session::get('cart', []);
                $existingCart = Cart::where('user_id', $user->id)->get()->keyBy('product_id');
                foreach ($cart as $item) {
                    if (isset($existingCart[$item['product_id']])) {
                        $existingCart[$item['product_id']]->delete();
                    }
        
                    $cartItem = new Cart([
                        'user_id' => $user->id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity']
                    ]);
        
                    $existingCart[$item['product_id']] = $cartItem;
                }
                if (!empty($existingCart)) {
                    foreach ($existingCart as $cartItem) {
                        $cartItem->save();
                    }
                }
        
                // Session::forget('cart');
                    if (Auth::check()) {
                        $redirUrl = route('checkout'); // Generate the URL for checkout
                        return redirect('/checkout'); // Redirect to home

                        // return response()->json([
                        //     'success' => 'Login Successful',
                        //     'redirUrl' => $redirUrl
                        // ], 200);
                    } else {
                        return response()->json([
                            'error' => 'Login Failed'
                        ], 401);
                    }
            }
    
            return response()->json(['error' => 'Invalid OTP or phone number.'], 400); // 400 Bad Request

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
            ->where('product_id', $productId)
            ->first();

        if (!$existingItem) {
            // Add to wishlist
            Wishlist::create([
                'user_id'    => $user->id,
                'product_id' => $productId,
                'categoryId' => $categoryId,
            ]);
        }
        // If it exists, we skip adding duplicate
    }

    // Clear the session wishlist
    Session::forget('wishlist');
}


private function mergeSessionCartWithDatabase($user)
{
    $cart = Session::get('cart', []);

    if (!is_array($cart) || empty($cart)) {
        return; // Nothing to process
    }

    // Get existing cart items from DB keyed by product_id
    $existingCart = Cart::where('user_id', $user->id)->get()->keyBy('product_id');

    foreach ($cart as $item) {
        if (!is_array($item) || !isset($item['product_id'], $item['quantity'])) {
            continue; // Skip invalid items
        }

        $productId = $item['product_id'];

        // Delete existing cart item with same product ID
        if (isset($existingCart[$productId])) {
            $existingCart[$productId]->delete();
        }

        // Create new cart item
        $cartItem = new Cart([
            'user_id'    => $user->id,
            'product_id' => $productId,
            'quantity'   => $item['quantity'],
            // Add 'categoryId' if needed: 'categoryId' => $item['category_id'] ?? null
        ]);

        $existingCart[$productId] = $cartItem;
    }

    // Save all new cart items to the DB
    foreach ($existingCart as $cartItem) {
        $cartItem->save();
    }

    // Clear the session cart
    Session::forget('cart');
}
    
}

