<?php

// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['first_name', 'last_name', 'total', 'city', 'address', 'phone', 'status_id', 'store_id', 'date_created', 'date_updated', 'date_deleted'];

    // Order.php

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
// Order.php

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
// Order.php

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }
    // Order.php

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

}
