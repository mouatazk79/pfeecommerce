<?php

// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'display_name', 'is_active'];

    // Category.php

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }

}


