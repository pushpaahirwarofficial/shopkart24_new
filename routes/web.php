<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\JewelryController;
use App\Http\Controllers\Frontend\SigninController;
use App\Http\Controllers\Frontend\AdminController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\Frontend\CustomForgotPasswordController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserSigninController;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Twilio\Rest\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/server-ip', function () {
    $ip = request()->server('SERVER_ADDR');
    return response()->json(['server_ip' => $ip]);
});


// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
// Route::get('/', function () {
//         return view('frontend.Index');
// });



Route::get('/test-guzzle', function () {
    if (class_exists(\GuzzleHttp\Client::class)) {
        return 'Guzzle is installed!';
    } else {
        return 'Guzzle is not installed.';
    }
});


Route::get('/send-sms', [SmsController::class, 'sendSms']);



Route::get('/', [AdminController::class, 'home'])->name('home');

// Route::get('/home', [HomeController::class, 'index']);
Route::get('/signin', [SigninController::class, 'index'])->name('user.login');
Route::post('/signin', [SigninController::class, 'handleLogin'])->name('store.login');

Route::get('/signin-phone', [UserSigninController::class, 'indexMobile'])->name('user.signinPhone');
Route::post('/send-otp-phone', [UserSigninController::class, 'sendOtp'])->name('user.signinSendOtp');
Route::post('/verify-otp-phone', [UserSigninController::class, 'verifyOtp'])->name('user.phoneVerifyOtp');

Route::get('/signin-temp', [SigninController::class, 'indexMobile'])->name('user.login.mobile');
Route::post('/send-otp', [SigninController::class, 'sendOtp'])->name('user.login.sendOtp');
Route::post('/verify-otp', [SigninController::class, 'verifyOtp'])->name('user.login.verifyOtp');

Route::get('/register', [SigninController::class, 'register'])->name('user.register');
Route::post('/register', [SigninController::class, 'handleRegister'])->name('store.register');
Route::post('/register-send-otp', [SigninController::class, 'registerSendOtp'])->name('user.register.sendOtp');
Route::post('/register-verify-otp', [SigninController::class, 'registerVerifyOtp'])->name('user.register.verifyOtp');

Route::post('/logout', [SigninController::class, 'logout'])->name('user.logout');

// routes/web.php

Route::get('/profile', [SigninController::class, 'show'])->middleware('auth');
    Route::get('/my-orders', [HomeController::class, 'order'])->name('orders.index')->middleware('auth');
    Route::get('/myorders/{id}', [HomeController::class, 'showOrderDetails'])->name('Orderdetails');


    // Route::get('/home', [HomeController::class, 'index']);
    Route::get('/about', [AboutController::class, 'index']);
    Route::get('/contact', [ContactController::class, 'index']);
    Route::post('/contact', [ContactController::class, 'submit']);
    Route::get('/privacy-policy', [AboutController::class, 'privacy']);
    Route::get('/refund_returns', [AboutController::class, 'refund_returns']);
    Route::get('/cart', [CartController::class, 'index']);    
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('/blog', [BlogController::class, 'index']);
    Route::get('/jewelry', [JewelryController::class, 'index']);


Route::get('/search', [HomeController::class, 'search'])->name('search');
    
Route::get('/admin', [AdminController::class, 'index']);

Route::get('/admin/dashboard', [AdminController::class, 'adminDashBoard'])->middleware('auth');
Route::post('/admin_login', [AdminController::class, 'login'])->name('admin.login');


// Product routes

Route::get('/admin/product', [AdminController::class, 'viewproduct'])->name('admin.product');
Route::post('/admin/product', [AdminController::class, 'addproduct'])->name('admin.product');
Route::get('/admin/showProduct', [AdminController::class, 'showProduct'])->name('admin.showProduct');
Route::get('/admin/deleteProduct/{id}',  [AdminController::class, 'deleteProduct'])->name('admin.deleteProduct');
Route::get('/admin/updateProduct/{id}',  [AdminController::class, 'updateShowProduct'])->name('admin.updateShowProduct');
Route::post('/admin/updateProduct',  [AdminController::class, 'updateProduct'])->name('admin.updateProduct');

    
// category routes

Route::get('/admin/category', [AdminController::class, 'viewCategory'])->name('admin.category');
Route::post('/admin/category', [AdminController::class, 'addCategory'])->name('admin.category');
Route::get('/admin/showcategory', [AdminController::class, 'allcategory'])->name('admin.allcategory');
Route::get('/admin/deletecategory/{id}', [AdminController::class, 'deleteCategory'])->name('admin.deleteCategory');
Route::get('/admin/updateShowCategory/{id}', [AdminController::class, 'updateShowCategory'])->name('admin.updateShowCategory');
Route::post('/admin/updateShowCategory', [AdminController::class, 'updateCategory'])->name('admin.updateCategory');

Route::get('/admin/dashboard', [AdminController::class, 'admin_dashboard'])->name('admin.dashboard');


//blog routes
Route::get('/admin/blog', [AdminController::class, 'addBlog'])->name('admin.addBlog');
Route::post('/admin/blog', [AdminController::class, 'storeBlog'])->name('admin.storeBlog');
Route::get('/admin/Showblog', [AdminController::class, 'viewBlog'])->name('admin.showBlog');


//orders
Route::get('/admin/Showorders', [AdminController::class, 'vieworders'])->name('admin.Showorders');
Route::get('/orders/{id}', [AdminController::class, 'showOrderDetails'])->name('admin.Orderdetails');


//coupons

// Route::get('/admin/coupons', [AdminController::class, 'viewCoupons'])->name('admin.coupons');
Route::post('/admin/coupons', [AdminController::class, 'addCoupons'])->name('admin.coupons');
Route::get('/admin/showcoupons', [AdminController::class, 'allcoupons'])->name('admin.allcoupons');
Route::get('/admin/deletecoupons/{id}', [AdminController::class, 'deleteCoupons'])->name('admin.deleteCoupons');
Route::get('/admin/updateShowCoupons/{id}', [AdminController::class, 'updateShowCoupons'])->name('admin.updateShowCoupons');
Route::post('/admin/updateShowCoupons', [AdminController::class, 'updateCoupons'])->name('admin.updateCoupons');
Route::get('/admin/updateStatusCoupons/{id}', [AdminController::class, 'updateStatusCoupons'])->name('admin.updateStatusCoupons');

//cart
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.delete');



//wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');


//fetch product based on category
Route::get('/category/{id}', [JewelryController::class, 'showByCategory'])->name('category.show');

Route::get('/product/{productId}', [JewelryController::class, 'show'])->name('product.view');
Route::get('/products/filter', [JewelryController::class, 'filter'])->name('product.filter');
Route::post('product/{product}/review', [JewelryController::class, 'addReview'])->name('product.addReview');
Route::post('reviews', [JewelryController::class, 'storereview'])->name('reviews.store');
// Route for updating reviews
Route::put('/product/{productId}/update-review', [JewelryController::class, 'updateReview'])->name('product.updateReview');

// routes/web.php
Route::get('/payment', [CartController::class, 'payment'])->name('razorpay.payment');
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment');
Route::post('/cod', [PaymentController::class, 'processCod'])->name('cod');

Route::get('/payment-stripe', [CartController::class, 'paymentStripe'])->name('stripe.payment');
Route::post('/payment-stripe', [PaymentController::class, 'processPaymentStripe'])->name('paymentStripe');

Route::get('/checkout/address', [CartController::class, 'showAddressForm'])->name('checkout.address');
Route::post('/checkout/address', [CartController::class, 'storeAddress'])->name('checkout.address.store');
Route::post('/checkout/select-address', [CartController::class, 'selectAddress'])->name('checkout.selectAddress');
Route::post('/checkout/payment', [CartController::class, 'showPaymentForm'])->name('checkout.payment');
// Route::post('/checkout/select-address', 'CheckoutController@selectAddress')->name('checkout.select-address');

// In web.php (routes file)
Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('apply.coupon');
Route::post('/apply-coupon-verify', [CartController::class, 'applyCouponVerify'])->name('apply.coupon.verify');
Route::get('/coupon-destroy', [CartController::class, 'couponDestroy'])->name('coupon.destroy');

Route::get('/payment/success', function () {
    return view('frontend.payment_success');
})->name('payment.success');
Route::get('/payment/failed', function () {
    return view('frontend.payment_failed');
})->name('payment.failed');

Route::get('/payment/success-stripe', [PaymentController::class, 'paymentSuccessStripe'])->name('payment.success.stripe');

Route::get('/cod/success', function () {
    return view('frontend.cod_success');
})->name('cod.success');
Route::get('/cod/failed', function () {
    return view('frontend.cod_failed');
})->name('cod.failed');

// Route::post('/payment', 'PaymentController@payment')->name('payment');


    
Route::get('/sale-of-the-week', [HomeController::class, 'sale_week'])->name('sale-week');

Route::get('forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [NewPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'reset'])->name('password.update');
    
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
});


Route::get('/temp-logout', function (\Illuminate\Http\Request $request) {
    // Log out the user
    Auth::logout();

    // Invalidate the session and regenerate the CSRF token
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect to login or home page
    return redirect('/')->with('message', 'Logged out successfully!');
})->name('user.temp_logout');


Route::get('/send-test-mail', function () {
    $to_email = 'ahirwarpushpa892@gmail.com'; // Replace with your actual email

    Mail::raw('This is a test email from Laravel using Gmail SMTP.', function ($message) use ($to_email) {
        $message->to($to_email)
                ->subject('Laravel Gmail SMTP Test');
    });

    return 'Test email sent successfully.';
});


Route::get('/test-sms', function () {
    $sid    = 'AC657b230f536d272d7f4de369a192339b';
    $token  = 'ae62f7853048bde5f1fc8c3283b561e4';
    $from   = '+15076936628'; // <- Match .env variable

    $to     = '+918989011290'; // Test recipient

    if (!$sid || !$token || !$from) {
        return response()->json([
            'success' => false,
            'error' => 'Missing Twilio configuration. Check .env file.',
        ]);
    }

    try {
        $twilio = new Client($sid, $token);

        $message = $twilio->messages->create($to, [
            'from' => $from,
            'body' => 'This is a test SMS from Laravel using Twilio.'
        ]);

        return response()->json([
            'success' => true,
            'sid' => $message->sid,
            'status' => $message->status,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
        ]);
    }
});


Route::get('/send-sms', function () {
    $response = Http::withHeaders([
        'authorization' => env('FAST2SMS_API_KEY'),
        'accept'        => 'application/json',
    ])->post(env('FAST2SMS_URL'), [
        'route'            => env('FAST2SMS_ROUTE', '4'),
        'sender_id'        => env('FAST2SMS_SENDER_ID', 'FSTSMS'),
        'message'          => 'Your OTP is 123456',
        'language'         => env('FAST2SMS_LANGUAGE', 'english'),
        'flash'            => 0,
        'numbers'          => '8989011290',
        'variables_values' => '123456',
    ]);

    return response()->json([
        'status' => $response->status(),
        'body'   => $response->body(),
        'json'   => $response->json(),
    ]);
});


Route::get('/check-env', function () {
    return [
        'TWILIO_SID' => env('TWILIO_SID'),
        'TWILIO_AUTH_TOKEN' => env('TWILIO_AUTH_TOKEN'),
        'TWILIO_PHONE' => env('TWILIO_PHONE'),
    ];
});

Route::get('/env-path', function () {
    return app()->environmentFilePath(); // See which .env file Laravel is using
});

