<?php

// app/Models/OrderStatusChange.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusChange extends Model
{
    protected $fillable = ['from_id', 'to_id'];
    // OrderStatusChange.php

    public function fromStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'from_id');
    }

    public function toStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'to_id');
    }

}

