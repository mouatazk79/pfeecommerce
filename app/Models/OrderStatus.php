<?php

// app/Models/OrderStatus.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = ['name', 'is_active'];

    // OrderStatus.php

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


}

