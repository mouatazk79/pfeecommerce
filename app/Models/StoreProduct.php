<?php

// app/Models/StoreProduct.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    protected $fillable = ['product_id', 'price', 'max_discount', 'is_active'];

    // StoreProduct.php

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    // StoreProduct.php

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}

