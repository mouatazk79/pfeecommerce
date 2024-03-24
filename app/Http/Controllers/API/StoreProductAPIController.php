<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStoreProductAPIRequest;
use App\Http\Requests\API\UpdateStoreProductAPIRequest;
use App\Models\StoreProduct;
use App\Repositories\StoreProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class StoreProductAPIController
 */
class StoreProductAPIController extends AppBaseController
{
    private StoreProductRepository $storeProductRepository;

    public function __construct(StoreProductRepository $storeProductRepo)
    {
        $this->storeProductRepository = $storeProductRepo;
    }

    /**
     * Display a listing of the StoreProducts.
     * GET|HEAD /store-products
     */
    public function index(Request $request): JsonResponse
    {
        $storeProducts = $this->storeProductRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($storeProducts->toArray(), 'Store Products retrieved successfully');
    }

    /**
     * Store a newly created StoreProduct in storage.
     * POST /store-products
     */
    public function store(CreateStoreProductAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $storeProduct = $this->storeProductRepository->create($input);

        return $this->sendResponse($storeProduct->toArray(), 'Store Product saved successfully');
    }

    /**
     * Display the specified StoreProduct.
     * GET|HEAD /store-products/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var StoreProduct $storeProduct */
        $storeProduct = $this->storeProductRepository->find($id);

        if (empty($storeProduct)) {
            return $this->sendError('Store Product not found');
        }

        return $this->sendResponse($storeProduct->toArray(), 'Store Product retrieved successfully');
    }

    /**
     * Update the specified StoreProduct in storage.
     * PUT/PATCH /store-products/{id}
     */
    public function update($id, UpdateStoreProductAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var StoreProduct $storeProduct */
        $storeProduct = $this->storeProductRepository->find($id);

        if (empty($storeProduct)) {
            return $this->sendError('Store Product not found');
        }

        $storeProduct = $this->storeProductRepository->update($input, $id);

        return $this->sendResponse($storeProduct->toArray(), 'StoreProduct updated successfully');
    }

    /**
     * Remove the specified StoreProduct from storage.
     * DELETE /store-products/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var StoreProduct $storeProduct */
        $storeProduct = $this->storeProductRepository->find($id);

        if (empty($storeProduct)) {
            return $this->sendError('Store Product not found');
        }

        $storeProduct->delete();

        return $this->sendSuccess('Store Product deleted successfully');
    }
}
