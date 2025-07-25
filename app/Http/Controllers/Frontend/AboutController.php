<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index() {
        $products = DB::table('product')
                  ->orderBy('createdAt', 'desc')
                  ->take(4)
                  ->get();
        $products->each(function ($product) {
            $images = explode('|', $product->image);
            $product->firstImage = $images[0] ?? ''; // Get the first image, or an empty string if there are no images
        });
        return view('frontend.about ' , compact('products'));
    }
    public function privacy() {
       
        return view('frontend.privacy');
    }
    public function refund_returns() {
       
        return view('frontend.refund_returns');
    }
}
