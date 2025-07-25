<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Review;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
class JewelryController extends Controller
{
public function index() {
    $user_id = auth()->user() ? auth()->user()->id : null;

    $products = DB::table('product')->get();
    $wishlistItems = $user_id ? Wishlist::where('user_id', $user_id)->pluck('product_id')->toArray() : [];

    // Process each product
    $products->each(function ($product) use ($wishlistItems) {
        // Get all images
        $images = explode('|', $product->image);
        $product->images = $images; // Pass all images to the view

        // Check if the product is in the user's wishlist
        $product->inWishlist = in_array($product->productId, $wishlistItems);
    });

    return view('frontend.jewelry', compact('products'));
}

  public function filter(Request $request)
{
    // Get the min and max price from the request
    $minPrice = $request->input('min_price', 0);
    $maxPrice = $request->input('max_price', 10000);

    // Convert prices to numeric types
    $minPrice = (float) $minPrice;
    $maxPrice = (float) $maxPrice;

    // Get the user ID if authenticated
    $user_id = auth()->user() ? auth()->user()->id : null;

    // Filter products by price using raw SQL for varchar conversion
    $products = Product::whereRaw('CAST(productPrice AS DECIMAL(10,2)) BETWEEN ? AND ?', [$minPrice, $maxPrice])->get();
    
    // Fetch wishlist items for the authenticated user
    $wishlistItems = $user_id ? Wishlist::where('user_id', $user_id)->pluck('product_id')->toArray() : [];

    // Process each product
    $products->each(function ($product) use ($wishlistItems) {
        // Get all images
        $images = explode('|', $product->image);
        $product->images = $images; // Pass all images to the view

        // Check if the product is in the user's wishlist
        $product->inWishlist = in_array($product->productId, $wishlistItems);
    });

    // Return the filtered products to the view
    return view('frontend.product_price', ['products' => $products]);
}

    
    public function earings(){
        
        return view('frontend.jewelry');
    }
    
public function showByCategory($id)
{
    // Fetch products based on the category ID
    $products = Product::where('categoryId', $id)->get();
    $catID = $id;
    $products->each(function ($product) {
        $images = explode('|', $product->image);
        $product->images = $images ?? []; // Ensure $product->images is always an array
        $product->firstImage = $images[0] ?? ''; // Get the first image, or an empty string if there are no images
    });
    // Pass products to the view
    return view('frontend.jewelry', compact('products', 'catID'));
}

public function show($productId)
{
    try {
        $product = Product::with('relatedProducts')->where('productId', $productId)->firstOrFail();
        $images = explode('|', $product->image);
        $product->images = $images ?? []; // Use an empty array if $images is null

        $product->relatedProducts->each(function ($relatedProduct) {
            $images = explode('|', $relatedProduct->image);
            $relatedProduct->images = $images ?? []; // Ensure $relatedProduct->images is always an array
        });

        $hasPurchased = false;
        $existingReview = null;

        if (Auth::check()) {
            $hasPurchased = OrderItem::where('product_id', $productId)
                ->whereHas('order', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->exists();

            $existingReview = Review::where('product_id', $productId)
                ->where('user_id', Auth::id())
                ->first();
        }
// dd($product->reviews);
        return view('frontend.view_product', compact('product', 'hasPurchased', 'existingReview'));
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Product not found, handle the error (e.g., redirect to a 404 page)
        abort(404);
    }
}

public function addReview(Request $request, $productId)
{
    $request->validate([
        'review' => 'required|string|max:255',
        'rating' => 'required|integer|min:1|max:5',
        'media.*' => 'nullable|mimes:jpg,jpeg,png,mp4,mov,avi|max:10240', // validate each file
    ]);

    // Create the review first
    $review = Review::create([
        'user_id' => auth()->id(),
        'product_id' => $productId,
        'review' => $request->review,
        'rating' => $request->rating,
    ]);

    // Handle file uploads
    if ($request->hasFile('media')) {
        // dd($request->file('media'));
        foreach ($request->file('media') as $file) {
            $path = $file->store('public/reviews'); // Store the file
            $review->medias()->create(['path' => 'app/'.$path]); // Save file path to the database
        }
    }

    return back()->with('success', 'Review added successfully.');
}

public function updateReview(Request $request, $productId)
{
    $request->validate([
        'review' => 'required|string|max:255',
        'rating' => 'required|integer|between:1,5',
        'review_id' => 'required|exists:reviews,id',
        'media.*' => 'nullable|mimes:jpg,jpeg,png,mp4,mov,avi|max:10240' // Validate each file in the array
    ]);

    $review = Review::find($request->review_id);

    if ($review && $review->user_id == auth()->id()) {
        // Update review text and rating
        $review->update([
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        // Remove old media files if any
        if ($request->remove_existing_media) {
            foreach ($review->medias as $media) {
                Storage::delete($media->path); // Delete file from storage
                $media->delete(); // Remove the record from the database
            }
        }

        // Handle new file uploads
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('public/reviews'); // Store the file
                $review->medias()->create(['path' => 'app/'.$path]); // Save file path to the database
            }
        }

        return redirect()->back()->with('success', 'Review updated successfully!');
    }

    return redirect()->back()->with('error', 'Unable to update review.');
}



    public function storereview(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product,productId',
            'rating' => 'required|integer|between:1,5',
            'review' => 'required|string|max:500',
        ]);

        // Check if the user has purchased the product
        $hasPurchased = OrderItem::where('product_id', $request->product_id)
                        ->whereHas('order', function ($query) {
                            $query->where('user_id', Auth::id());
                        })
                        ->exists();

        if (!$hasPurchased) {
            return redirect()->back()->with('error', 'You can only review products you have purchased.');
        }

        // Check if the user has already reviewed this product
        $hasReviewed = Review::where('product_id', $request->product_id)
                             ->where('user_id', Auth::id())
                             ->exists();

        if ($hasReviewed) {
            return redirect()->back()->with('error', 'You have already reviewed this product.');
        }

        // Save the review
        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->back()->with('success', 'Your review has been submitted.');
    }

}
