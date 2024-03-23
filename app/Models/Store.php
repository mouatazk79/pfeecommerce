<?php

// app/Models/Store.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name', 'domain', 'theme', 'logo_url'];
    // Store.php

    public function storeProducts()
    {
        return $this->hasMany(StoreProduct::class);
    }

}

