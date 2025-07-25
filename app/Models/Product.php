<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product'; // Ensure this matches your actual table name
    protected $primaryKey = 'productId';

    public $timestamps = true; // Assuming you want to use createdAt and updatedAt columns

    protected $fillable = [
        'categoryId',
        'subCategoryId',
        'productName',
        'productPrice',
        'productSalePrice',
        'productDescription',
        'productRating',
        'productType',
        'image',
         'sale_of_week',
         'charges'
    ];

    protected $dates = ['createdAt', 'updatedAt']; // Ensures createdAt and updatedAt are treated as dates
    
    public function orders()
    {
        // Adjusted relationship to use the correct table and column names
        return $this->belongsToMany(Order::class, 'order_product', 'product_productId', 'order_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
    
    public function reviews()
{
    return $this->hasMany(Review::class, 'product_id', 'productId');
}

public function relatedProducts()
{
    return $this->hasMany(Product::class, 'categoryId', 'categoryId')
                ->where('productId', '!=', $this->productId)
                ->limit(4);
}

    
//     public function images()
// {
//     return $this->hasMany(ProductImage::class);
// }
}
