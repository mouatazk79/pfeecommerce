<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{

    use HasFactory;


    protected $fillable = ['name', 'short_description', 'long_description', 'is_simple', 'main_picture_url', 'is_active', 'slug'];

    // Product.php


    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }
    // Product.php

    public function variations(): HasMany
    {
        return $this->hasMany(ProductVariation::class);
    }

}

