<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blog';

    protected $fillable = [
        'title',
        'title_url',
        'meta_title',
        'meta_desc',
        'description',
        'body',
        'img_url',
        'post_code',
        'category',
        'auth_name',
    ];
}
