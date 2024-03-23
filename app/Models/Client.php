<?php

// app/Models/Client.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['last_name', 'first_name', 'phone', 'city', 'address', 'email', 'password'];
    // Client.php

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}

