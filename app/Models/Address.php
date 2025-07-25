<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    
      protected $fillable = [
        'user_id',
        'fname',
        'lname',
        'pincode',
        'flat',
        'area',
        'landmark',
        'town_city',
        'state',
        'number',
        'address_type'
    ];
    
     public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Define the inverse relationship if needed
    public function orders()
    {
        return $this->hasMany(Order::class, 'address_id');
    }
}
