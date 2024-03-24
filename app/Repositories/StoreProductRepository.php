<?php

namespace App\Repositories;

use App\Models\StoreProduct;
use App\Repositories\BaseRepository;

class StoreProductRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'product_id',
        'store_id',
        'price',
        'max_discount',
        'is_active'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return StoreProduct::class;
    }
}
