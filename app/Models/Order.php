<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
     protected $fillable = [
        'user_id', 'razorpay_order_id', 'razorpay_payment_id', 'razorpay_signature', 'amount', 'status'
    ];

        // Define the relationship to the OrderItem model
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function product()
    {
        // Adjusted relationship to use the correct table and column names
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')
                    ->withTimestamps();
    }// Define the relationship with the Address model
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

}
