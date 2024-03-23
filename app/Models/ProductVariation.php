<?php

// app/Models/ProductVariation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $fillable = ['product_id', 'name', 'description', 'is_active', 'slug'];

    // ProductVariation.php

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // ProductVariation.php

    public function attributes()
    {
        return $this->hasMany(ProductVariationAttribute::class);
    }

    // ProductVariation.php

    public function photos()
    {
        return $this->hasMany(ProductVariationPhoto::class);
    }

}

