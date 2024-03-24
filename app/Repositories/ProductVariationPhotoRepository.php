<?php

namespace App\Repositories;

use App\Models\ProductVariationPhoto;
use App\Repositories\BaseRepository;

class ProductVariationPhotoRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'variation_id',
        'photo_url'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProductVariationPhoto::class;
    }
}
