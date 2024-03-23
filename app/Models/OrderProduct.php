<?php

// app/Models/OrderProduct.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['order_id', 'product_variation_id', 'qte', 'price'];
    // OrderProduct.php

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    // OrderProduct.php

    public function productVariation()
    {
        return $this->belongsTo(ProductVariation::class);
    }

}

