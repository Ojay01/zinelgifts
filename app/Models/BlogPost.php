<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'body', 'slug', 'thumbnail'];

    // Optionally, add a method to generate URLs for each post
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
