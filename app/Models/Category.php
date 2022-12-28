<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $guarded = [];

    // //getImageAttribute
    // public function getImageAttribute($image)
    // {
    //     return asset('storage/categories/'.$image);
    // }

    public function getImageAttribute($image)
    {
        return asset('storage/categories/'.$image);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
