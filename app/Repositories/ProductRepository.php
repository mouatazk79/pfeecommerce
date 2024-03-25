<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{


    public function model(): string
    {
        return Product::class;
    }
    public function create(array $data): Product
    {
        return Product::create($data);
    }

}
