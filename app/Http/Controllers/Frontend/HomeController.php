<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Order; // Import the Blog model

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $couponsWithCategory = DB::table('coupons')
            ->join('category', 'coupons.category_id', '=', 'category.id')
            ->select('coupons.*', 'category.name as category_name')
            ->get();
            return view('frontend.Index', $couponsWithCategory);
    }
    
    
  public function search(Request $request)
    {
        // $query = $request->input('query');



  $query = $request->input('query');

        // Search products by name or description
        $products = DB::table('product')
            ->where('productName', 'LIKE', "%$query%")
            ->orWhere('productDescription', 'LIKE', "%$query%")
            ->orderBy('createdAt', 'desc')
            ->take(4)
            ->get();

        // Process images
        $products->each(function ($product) {
            $images = explode('|', $product->image);
            $product->firstImage = $images[0] ?? ''; // Get the first image, or an empty string if there are no images
        });

        return view('frontend.search', compact('products', 'query'));
    }
  public function sale_week()
    {
    $user_id = auth()->user() ? auth()->user()->id : null;
        $products = Product::where('sale_of_week', true)->get();
            $wishlistItems = $user_id ? Wishlist::where('user_id', $user_id)->pluck('product_id')->toArray() : [];
  $products->each(function ($product) use ($wishlistItems) {
        // Get all images
        $images = explode('|', $product->image);
        $product->images = $images; // Pass all images to the view

        // Check if the product is in the user's wishlist
        $product->inWishlist = in_array($product->productId, $wishlistItems);
    });

        return view('frontend.sale-of-the-week', compact('products'));
    }


public function order()
{
    // Fetch orders for the logged-in user with order items and products
    $orders = Order::with(['user', 'orderItems.product'])->where('user_id', auth()->id())->get();
    
    // Calculate total quantity for each order
    foreach ($orders as $order) {
        $order->total_quantity = $order->orderItems->sum('quantity');
        $order->item_statuses = $order->orderItems->pluck('item_status')->toArray();
    }

    // Pass orders to the view
    return view('frontend.orders', compact('orders'));
}



  public function showOrderDetails($id)
    {
        // Retrieve the order along with its related user and orderItems
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
    
        // Return the view with order data
        return view('frontend.myorderdetails', compact('order'));
    }

//  public function search(Request $request)
//     {
//         $searchTerm = $request->input('query');

//         // Perform search logic, e.g., querying products
//         $products = Product::where('productName', 'like', "%$searchTerm%")
//                           ->orWhere('productDescription', 'like', "%$searchTerm%")
//                           ->get();

//         return response()->json(['products' => $products]);
//     }
}
