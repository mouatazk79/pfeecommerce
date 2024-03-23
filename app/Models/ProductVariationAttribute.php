<?php

// app/Models/ProductVariationAttribute.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariationAttribute extends Model
{
    protected $fillable = ['variation_id', 'attribute_id', 'option_id'];

    // ProductVariationAttribute.php

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }

}


