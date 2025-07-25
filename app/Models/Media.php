<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    
    protected $fillable = ['review_id', 'path'];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

}
