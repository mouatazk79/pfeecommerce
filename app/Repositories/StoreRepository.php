<?php

namespace App\Repositories;

use App\Models\Store;
use App\Repositories\BaseRepository;

class StoreRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'domain',
        'theme',
        'logo_url'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Store::class;
    }
}
