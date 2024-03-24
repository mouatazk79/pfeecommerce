<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'total',
        'city',
        'address',
        'phone',
        'status_id',
        'store_id',
        'client_id',
        'date_created',
        'date_updated',
        'date_deleted'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Order::class;
    }
}
