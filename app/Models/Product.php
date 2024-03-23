<?php

// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'short_description', 'long_description', 'is_simple', 'main_picture_url', 'is_active', 'slug'];

    // Product.php

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }
    // Product.php

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

}

