<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Product; // Import the Blog model
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; // Make sure this line is present
use App\Models\Cart; // Ensure this line is present
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use DB;

class WishlistController extends Controller
{
    //
   
//   public function index()
// {
//     $user_id = auth()->user() ? auth()->user()->id : null;
//     $wishlistItems = Wishlist::with('product')->where('user_id', $user_id)->get();

//     return view('frontend.wishlist', ['wishlistItems' => $wishlistItems]);
// }

public function index()
{
    $wishlistItems = [];

    if (auth()->check()) {
        // User is logged in, fetch wishlist items from database
        $user_id = auth()->user()->id;
        $wishlistItems = Wishlist::with('product')->where('user_id', $user_id)->get();
    } else {
        // User is not logged in, fetch wishlist items from session
        $wishlist = session()->get('wishlist', []);
        $wishlistItems = Product::whereIn('productId', $wishlist)->get()->map(function ($product) {
            return (object)['product' => $product];
        });
    }

    return view('frontend.wishlist', ['wishlistItems' => $wishlistItems]);
}



    
//   public function add(Request $request)
// {
//     $user_id = auth()->user() ? auth()->user()->id : null;
//     $product_id = $request->input('product_id');

//     // Check if the product is already in the wishlist
//     $wishlistItem = Wishlist::where('user_id', $user_id)
//         ->where('product_id', $product_id)
//         ->first();

//     if ($wishlistItem) {
//         // Product is already in the wishlist, show a message
//         return redirect()->back()->with('error', 'Product is already in wishlist');
//     }

//     // Product is not in the wishlist, add it
//     Wishlist::create([
//         'user_id' => $user_id,
//         'product_id' => $product_id
//     ]);

//     return redirect()->back()->with('success', 'Product added to wishlist successfully!');
// }

   
   
public function add(Request $request)
{
    if (auth()->check()) {
        // User is logged in, add item to database
        $user_id = auth()->user()->id;
        $product_id = $request->input('product_id');

        $categoryId = DB::table('product')->where('productId', $product_id)->first()->categoryId;

        // Check if the product is already in the wishlist
        $wishlistItem = Wishlist::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($wishlistItem) {
            // Product is already in the wishlist, show a message
            return redirect()->back()->with('error', 'Product is already in wishlist');
        }

        // Product is not in the wishlist, add it
        Wishlist::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'categoryId' => $categoryId
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist successfully!');
    } else {
        // User is not logged in, store item in session
        $product_id = $request->input('product_id');
        $wishlist = session()->get('wishlist', []);

        if (in_array($product_id, $wishlist)) {
            // Product is already in the wishlist, show a message
            return redirect()->back()->with('error', 'Product is already in wishlist');
        }

        // Add product to the wishlist
        $wishlist[] = $product_id;
        session()->put('wishlist', $wishlist);

        return redirect()->route('wishlist.index')->with('error', 'Login to add product to wishlist');
    }
}
 
    
    
    
    
//     public function remove($id)
// {
//     Wishlist::findOrFail($id)->delete();
//     return redirect()->route('wishlist.index')->with('success', 'Item removed from wishlist');
// }



public function remove($id)
{
    if (auth()->check()) {
        // User is logged in, remove item from database
        Wishlist::where('user_id', auth()->user()->id)->where('product_id', $id)->delete();
    } else {
        // User is not logged in, remove item from session
        $wishlist = session()->get('wishlist', []);
        $key = array_search($id, $wishlist);
        if ($key !== false) {
            unset($wishlist[$key]);
            session()->put('wishlist', $wishlist);
        }
    }

    return redirect()->route('wishlist.index')->with('success', 'Item removed from wishlist');
}


}
