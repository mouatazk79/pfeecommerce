<?php

namespace App\Repositories;

use App\Models\ProductVariationAttribute;
use App\Repositories\BaseRepository;

class ProductVariationAttributeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'variation_id',
        'attribute_id',
        'option_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProductVariationAttribute::class;
    }
}
