<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog; // Import the Blog model
use App\Models\Order; // Import the Blog model
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view("frontend.admin.index");
    }
    public function home(){
$products = DB::table('product')
                  ->orderBy('createdAt', 'desc')
                  ->take(4)
                  ->get();
        $products->each(function ($product) {
            $images = explode('|', $product->image);
            $product->firstImage = $images[0] ?? ''; // Get the first image, or an empty string if there are no images
        });
        return view("frontend.Index", compact('products'));
    }
    public function login(Request $request) {
        // Retrieve user input from the form
        $username = $request->input('username');
        $password = $request->input('password');
        
        // Query the database to find a user with the provided username
        $user = DB::table('admin')->where('adminUsername', $username)->first();
        // dd($password); die;
        // Check if a user with the provided username exists
        if ($user) {
            // Verify the password
        if (Hash::check($password, $user->adminPassword)) {
                // Password is correct; you can log in the user here
                // Typically, you'd set a session variable to indicate the user is logged in
                // dd(1); die;

                // For example, you can store the user ID in the session
                session(['adminUsername' => $user->adminUsername]);

                // Redirect to a dashboard or home page
             $categories = DB::table('category')->get(); // Replace 'categories' with your actual table name
                // return view('frontend.admin.addProduct', compact('categories'));
            return Redirect::route('admin.dashboard', compact('categories'));

            }
            // dd(2); die;

        }
        // If the login fails, redirect back with an error message
        return redirect()->back()->with('error', 'Invalid username or password');
    }

    public function admin_dashboard(){
        
         $products = DB::table('product')->get();

        // Modify the 'image' column to get the first image URL
        $products->each(function ($product) {
            $images = explode('|', $product->image);
            $product->firstImage = $images[0] ?? ''; // Get the first image, or an empty string if there are no images
        });

        return view('frontend.admin.showproduct', compact('products'));
    }

    public function adminDashBoard(){
        return view("frontend.admin.product");
    }

    public function viewCategory(){
        return view("frontend.admin.category");
    }

    public function addCategory(Request $request) {
        $categoryName = $request->input('categoryName');
    
        // Insert the new category
        $inserted = DB::table('category')->insert([
            'categoryName' => $categoryName
        ]);
    
        if ($inserted) {
            // Category added successfully, redirect with a success message
            return redirect()->back()->with(['success' => 'Category added successfully']);
            //return redirect()->route('admin.category')->with('success', 'Category added successfully');
        } else {
            // Category insertion failed, redirect with an error message if needed
            return redirect()->back()->with(['error' =>"Category Not Added Successfully"]);
        }
    }


    public function viewSubCategory(){
        $categories = DB::table('category')->get(); // Replace 'categories' with your actual table name
        return view('frontend.admin.addSubCategory', compact('categories'));

    }


    public function addSubCategory(Request $request) {
        $categoryId = $request->input('categoryId');
        $subcategoryName = $request->input('subcategoryName');
    
        // Insert the new category
        $inserted = DB::table('subCategory')->insert([
            'categoryId' => $categoryId,
            'subCategoryName' => $subcategoryName,
        ]);
    
        if ($inserted) {
            // Category added successfully, redirect with a success message
            return redirect()->back()->with('message',"Sub Category Added Successfully");
            //return redirect()->route('admin.category')->with('success', 'Category added successfully');
        } else {
            // Category insertion failed, redirect with an error message if needed
            return redirect()->back()->with('message',"Category Not Added Successfully");
        }
    }

    public function viewproduct(){
        $categories = DB::table('category')->get(); // Replace 'categories' with your actual table name
        return view('frontend.admin.addProduct', compact('categories'));
    }

public function addproduct(Request $request)
{
    $request->validate([
        'categoryId' => 'required|integer|exists:category,categoryId',
        'productName' => 'required|string|max:255',
        'productPrice' => 'required|numeric',
        'productSalePrice' => 'nullable|numeric',
        'productDescription' => 'nullable|string',
        'productRating' => 'nullable|numeric|min:0|max:5',
        'productType' => 'nullable|string',
        'charges' => 'nullable|numeric',
        'sale_of_week' => 'nullable|boolean',
        // 'image' => 'required|array',
        // 'image.*' => 'file|mimes:jpeg,png,jpg,gif,webp|max:5120',
    ]);

    $images = [];

    if ($files = $request->file('image')) {
        foreach ($files as $file) {
            $name = 'img' . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image'), $name);
            $images[] = $name;
        }
    }

    DB::table('product')->insert([
        'categoryId' => $request->input('categoryId'),
        'productName' => $request->input('productName'),
        'productPrice' => $request->input('productPrice'),
        'productSalePrice' => $request->input('productSalePrice'),
        'productDescription' => $request->input('productDescription'),
        'productRating' => $request->input('productRating'),
        'productType' => $request->input('productType'),
        'image' => implode('|', $images),
        'sale_of_week' => $request->input('sale_of_week', 0),
        'charges' => $request->input('charges'),
    ]);

    return redirect('admin/showProduct')->with(['success' => 'Product added successfully']);
}


    public function showProduct(){
       
        $products = DB::table('product')->get();

        // Modify the 'image' column to get the first image URL
        $products->each(function ($product) {
            $images = explode('|', $product->image);
            $product->firstImage = $images[0] ?? ''; // Get the first image, or an empty string if there are no images
        });

        return view('frontend.admin.showproduct', compact('products'));
    }


    public function deleteProduct($id) {
        // Delete the product based on the product ID
        $affectedRows = DB::table('product')->where('productId', $id)->delete();
    
        if ($affectedRows > 0) {
            // Product deleted successfully
            return redirect()->route('admin.showProduct')->with('success', 'Product deleted successfully.');
            
        } else {
            // Product not found or deletion failed
            return redirect()->route('admin.showProduct')->with('error', 'Product not found or deletion failed.');
        }
    }

    public function updateShowProduct($id) {
        // Retrieve the data of the product with the specified ID
        $productData = DB::table('product')
            ->join('category', 'product.categoryId', '=', 'category.categoryId')
            // ->join('subCategory', 'product.subCategoryId', '=', 'subCategory.subCategoryId')
            ->select('product.*', 'category.categoryName',  'category.categoryId')
            ->where('product.productId', $id) // Filter by product ID
            ->first(); // Get the first matching record
    
        if (!$productData) {
            // Handle the case where the product with the given ID is not found
            // For example, you can redirect to a 404 page or display an error message
        }
    
        // $productData now contains the data of the product with the specified ID
        // You can pass this data to a view or use it as needed for updating the product's information
        $categories = DB::table('category')->get(); // Replace 'categories' with your actual table name
        return view('frontend.admin.updateProduct', compact('productData', 'categories'));
    }


    public function updateProduct(Request $request) {
    $id = $request->input('productId');

    // Handle image deletion
    if ($request->has('deleteImages')) {
        foreach ($request->deleteImages as $imageToDelete) {
            $imagePath = public_path('image/' . $imageToDelete);

            if (file_exists($imagePath)) {
                // Delete the image file from your storage
                unlink($imagePath);
            }

            // Remove the image name from the database
            $productData = DB::table('product')->where('productId', $id)->first();
            $images = explode('|', $productData->image);
            $updatedImages = array_diff($images, [$imageToDelete]);
            DB::table('product')->where('productId', $id)->update(['image' => implode('|', $updatedImages)]);
        }
    }

    // Handle image upload
    if ($request->hasFile('newImages')) {
        $newImages = $request->file('newImages');
        $imagesToAdd = [];

        foreach ($newImages as $newImage) {
            // Generate a unique name for the new image
            $imageName = time() . '_' . $newImage->getClientOriginalName();
            
            // Move the new image to your server
            $newImage->move(public_path('image'), $imageName);

            // Add the image name to the list of images to be added to the database
            $imagesToAdd[] = $imageName;
        }

        // Update the database to include the new images (only if new images were uploaded)
        if (!empty($imagesToAdd)) {
            $productData = DB::table('product')->where('productId', $id)->first();
            $images = explode('|', $productData->image);
            $images = array_merge($images, $imagesToAdd);
        
            // Remove empty strings (including "")
            $images = array_filter($images, function ($value) {
                return $value !== "";
            });
        
            // Update the database with the cleaned images array
            DB::table('product')->where('productId', $id)->update(['image' => implode('|', $images)]);
        }
    }

    // Update product details (e.g., name, price, description)
    DB::table('product')->where('productId', $id)->update([
        'categoryId' => $request->input('categoryId'),
        'productName' => $request->productName,
        'productPrice' => $request->productPrice,
        'productSalePrice' => $request->productSalePrice,
        'productDescription' => $request->productDescription,
        'productRating' => $request->productRating,
        'sale_of_week' => $request->input('sale_of_week'),
        'charges' => $request->input('charges'),
    ]);

    return redirect()->route('admin.updateShowProduct', ['id' => $id])->with(['success' => 'Product updated successfully']);
}
    
    public function getSubCategories(Request $request) {
        $categoryId = $request->input('categoryId');
        $subCategories = DB::table('subCategory')
            ->where('categoryId', $categoryId)
            ->get();
    
        return response()->json($subCategories);
    }

    public function allcategory(){
        $category = DB::table('category')->get();
        return view('frontend.admin.showAllCategory', compact('category'));
    }


    public function deleteCategory($id){
        $affectedRows = DB::table('category')->where('categoryId', $id)->delete();
        if ($affectedRows > 0) {
            // Product deleted successfully
            return redirect()->route('admin.allcategory')->with(['success'=> 'Category deleted successfully.']);
            
        } else {
            // Product not found or deletion failed
            return redirect()->route('admin.allcategory')->with('message', 'Category not found or deletion failed.');
        }
    }

    public function updateShowCategory($id) {
        $category = DB::table('category')->where('categoryId', $id)->first();
    
        if ($category) {
            return view('frontend.admin.updateCategory', compact('category'));
        } else {
            // Handle the case where the category with the provided ID is not found
            return redirect()->route('admin.categoryNotFound');
        }
    }

    public function updateCategory(Request $request){
        $id = $request->input('categoryId');
        $categoryName = $request->input('categoryName');
        DB::table('category')->where('categoryId', $id)->update([
            'categoryName' => $categoryName,
            
        ]);
        return redirect()->route('admin.allcategory')->with('message', 'Category Updated Successfully');
    }

    public function showSubCategory(){
        $subCategory = DB::table('subCategory')->get();
        return view('frontend.admin.showAllSubCategory', compact('subCategory'));
    }

    public function deleteSubCategory($id){
        $affectedRows = DB::table('subCategory')->where('subCategoryId', $id)->delete();
        if ($affectedRows > 0) {
            // Product deleted successfully
            return redirect()->route('admin.showSubCategory')->with('message', 'Sub Category deleted successfully.');
            
        } else {
            // Product not found or deletion failed
            return redirect()->route('admin.showSubCategory')->with('message', 'Sub Category not found or deletion failed.');
        }
    }

    public function updateShowSubCategory($id){
        $Data = DB::table('subCategory')
        ->join('category', 'subCategory.categoryId', '=', 'category.categoryId')
        ->select('subCategory.*', 'category.categoryName', 'subCategory.subCategoryName', 'category.categoryId', 'subCategory.subCategoryId')
        ->where('subCategory.subCategoryId', $id) // Filter by product ID
        ->first(); // Get the first matching record

        if (!$Data) {
            // Handle the case where the product with the given ID is not found
            // For example, you can redirect to a 404 page or display an error message
        }

        // $productData now contains the data of the product with the specified ID
        // You can pass this data to a view or use it as needed for updating the product's information
        $categories = DB::table('category')->get(); // Replace 'categories' with your actual table name
        return view('frontend.admin.updateShowSubCategory', compact('Data', 'categories'));
    }

    public function updateSubCategory(Request $request){
   
        $subCategoryName = $request->input('subCategoryName');
        $subCategoryId = $request->input('subCategoryId');
        $categoryId = $request->input('categoryId');


        DB::table('subCategory')->where('subCategoryId', $subCategoryId)->update([
            'categoryId' => $categoryId,
            'subCategoryName' => $subCategoryName,
            
        ]);

        return redirect()->route('admin.showSubCategory')->with('message', 'Sub Category updated successfully');
    }
    
    
     public function logout(Request $request)
    {
       Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
    }
    
    public function viewBlog(){
                $blogs = Blog::all();

        
        return view('frontend.admin.showBlog', compact('blogs'));
    }
    public function addBlog(){
        return view('frontend.admin.addBlog');
    }
    public function storeBlog(Request $request){
        
        $validated = $request->validate([
            'title' => 'required',
            'title_url' => 'required',
            'meta_title' => 'required|max:5000',
            'meta_desc' => 'required',
            'description' => 'required',
            'body' => 'required',
            'img_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'post_code' => 'nullable|max:10',
            'category' => 'nullable|max:255',
            'auth_name' => 'nullable|max:255',
        ]);
        if ($request->hasFile('img_url')) {
            $imageName = time().'.'.$request->img_url->extension();
            $request->img_url->move(public_path('images'), $imageName);
            $validated['img_url'] = $imageName;
        }

        // Create a new blog post
        Blog::create($validated);
        
        return redirect()->route('admin.showBlog')->with(['success'=> 'Blog added  successfully']);
    }
    
    
    
    public function viewOrders()
    {
        // Load orders with their related user and order items
        $orders = Order::with(['user', 'orderItems'])->get();
        
        // Calculate total quantity for each order
        foreach ($orders as $order) {
            $order->total_quantity = $order->orderItems->sum('quantity');
        }
    
        return view('frontend.admin.showorders', compact('orders'));
    }

    // Method to show order details
    public function showOrderDetails($id)
    {
        // Retrieve the order along with its related user and orderItems
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
    
        // Return the view with order data
        return view('frontend.admin.orderdetails', compact('order'));
    }
    
    
    public function allcoupons(){
        $coupons = DB::table('coupons')->get();
        $products = DB::table('product')->get();
        $category = DB::table('category')->get();
        return view('frontend.admin.showAllCoupons', compact('coupons', 'products', 'category'));
    }
    

    public function addCoupons(Request $request)
    {
        // Validate the request
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'discount_type' => 'required|in:fixed,percent',
            'discount_amount' => 'required|numeric|min:0',
            'expires_at' => 'required|date',
            'product_name' => 'required|unique:coupons,product_code'
        ], [
            'code.required' => 'The coupon code is required.',
            'code.unique' => 'The coupon code must be unique.',
            'discount_type.required' => 'Please select a discount type.',
            'discount_type.in' => 'The selected discount type is invalid.',
            'discount_amount.required' => 'The discount amount is required.',
            'discount_amount.numeric' => 'The discount amount must be a number.',
            'discount_amount.min' => 'The discount amount must be at least 0.',
            'expires_at.required' => 'The expiration date is required.',
            'expires_at.date' => 'The expiration date is not a valid date.',
            'product_name.required' => 'Please select a product.',
            'product_name.unique' => 'The selected product must be unique.',
        ]);
    
        // Insert the coupon into the database
        DB::table('coupons')->insert([
            'code' => strtoupper($request->code),
            'discount_type' => $request->discount_type,
            'discount_amount' => $request->discount_amount,
            'expires_at' => $request->expires_at,
            'product_code' => $request->product_name,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->route('admin.allcoupons')->with('success', 'Coupon created successfully!');
    }




    public function deleteCoupons($id){
        $affectedRows = DB::table('coupons')->where('id', $id)->delete();
        if ($affectedRows > 0) {
            // Product deleted successfully
            return redirect()->route('admin.allcoupons')->with(['success'=> 'Coupon deleted successfully.']);
            
        } else {
            // Product not found or deletion failed
            return redirect()->route('admin.allcoupons')->with('message', 'Coupon not found or deletion failed.');
        }
    }

    public function updateShowCoupons($id) {
        $coupon = DB::table('coupons')->where('id', $id)->first();
        $products = DB::table('product')->get();
        $category = DB::table('category')->get();
        if ($coupon) {
            return view('frontend.admin.updateCoupon', compact('coupon', 'products', 'category'));
        } else {
            // Handle the case where the category with the provided ID is not found
            return redirect()->route('admin.couponNotFound');
        }
    }

public function updateCoupons(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'categoryId' => 'required|exists:coupons,id', // Ensure the categoryId exists in the coupons table
        'couponName' => 'required|string|max:255|unique:coupons,code,' . $request->input('categoryId'), // Unique except for the current coupon
        'discount_type' => 'required|in:fixed,percent',
        'discount_amount' => 'required|numeric|min:0',
        'expire_at' => 'required|date',
        // 'product_name' => 'unique:coupons,product_code',
    ], [
        'categoryId.required' => 'The coupon ID is required.',
        'categoryId.exists' => 'The selected coupon does not exist.',
        'couponName.required' => 'The coupon code is required.',
        'couponName.string' => 'The coupon code must be a string.',
        'couponName.max' => 'The coupon code may not be greater than 255 characters.',
        'couponName.unique' => 'The coupon code must be unique.',
        'discount_type.required' => 'Please select a discount type.',
        'discount_type.in' => 'The selected discount type is invalid.',
        'discount_amount.required' => 'The discount amount is required.',
        'discount_amount.numeric' => 'The discount amount must be a number.',
        'discount_amount.min' => 'The discount amount must be at least 0.',
        'expire_at.required' => 'The expiration date is required.',
        'expire_at.date' => 'The expiration date is not a valid date.',
        // 'product_name.required' => 'Please select a product.',
        // 'product_name.unique' => 'The selected product must be unique.',
    ]);
    
    // Retrieve input values
    $id = $request->input('categoryId');
    $couponName = strtoupper($request->input('couponName')); // Convert coupon code to uppercase
    $discountType = $request->input('discount_type');
    $discountAmount = $request->input('discount_amount');
    $expiresAt = $request->input('expire_at');
    $product_code = $request->input('product_name');

    // Update the coupon in the database
    DB::table('coupons')->where('id', $id)->update([
        'code' => $couponName,
        'discount_type' => $discountType,
        'discount_amount' => $discountAmount,
        'expires_at' => $expiresAt,
        'product_code' => $product_code,
        'updated_at' => now(), // Update timestamp
    ]);

    return redirect()->route('admin.allcoupons')->with('message', 'Coupon Updated Successfully');
}

    
    
    public function updateStatusCoupons($id) 
    {
        $coupon = DB::table('coupons')->where('id', $id)->first();
        
        if ($coupon) {
            // Toggle the is_active status
            $newStatus = !$coupon->is_active; // If it is currently active, set to inactive, and vice versa
            
            DB::table('coupons')->where('id', $id)->update([
                'is_active' => $newStatus,
                'updated_at' => now(), // Update timestamp
            ]);
    
            return redirect()->route('admin.allcoupons')->with('message', 'Coupon status updated successfully!');
        } else {
            // Handle the case where the coupon with the provided ID is not found
            return redirect()->route('admin.allcoupons')->with('error', 'Coupon not found.');
        }
    }


    
}
