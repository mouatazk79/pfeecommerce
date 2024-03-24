<?php

namespace App\Repositories;

use App\Models\ProductVariation;
use App\Repositories\BaseRepository;

class ProductVariationRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'product_id',
        'name',
        'description',
        'is_active',
        'slug'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProductVariation::class;
    }
}
