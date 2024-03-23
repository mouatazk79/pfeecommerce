<?php

// app/Models/ProductVariationPhoto.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariationPhoto extends Model
{
    protected $fillable = ['variation_id', 'photo_url'];
    // ProductVariationPhoto.php

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }

}



