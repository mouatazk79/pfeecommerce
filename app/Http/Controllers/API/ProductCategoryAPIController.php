<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductCategoryAPIRequest;
use App\Http\Requests\API\UpdateProductCategoryAPIRequest;
use App\Models\ProductCategory;
use App\Repositories\ProductCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ProductCategoryAPIController
 */
class ProductCategoryAPIController extends AppBaseController
{
    private ProductCategoryRepository $productCategoryRepository;

    public function __construct(ProductCategoryRepository $productCategoryRepo)
    {
        $this->productCategoryRepository = $productCategoryRepo;
    }

    /**
     * Display a listing of the ProductCategories.
     * GET|HEAD /product-categories
     */
    public function index(Request $request): JsonResponse
    {
        $productCategories = $this->productCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($productCategories->toArray(), 'Product Categories retrieved successfully');
    }

    /**
     * Store a newly created ProductCategory in storage.
     * POST /product-categories
     */
    public function store(CreateProductCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $productCategory = $this->productCategoryRepository->create($input);

        return $this->sendResponse($productCategory->toArray(), 'Product Category saved successfully');
    }

    /**
     * Display the specified ProductCategory.
     * GET|HEAD /product-categories/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var ProductCategory $productCategory */
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            return $this->sendError('Product Category not found');
        }

        return $this->sendResponse($productCategory->toArray(), 'Product Category retrieved successfully');
    }

    /**
     * Update the specified ProductCategory in storage.
     * PUT/PATCH /product-categories/{id}
     */
    public function update($id, UpdateProductCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ProductCategory $productCategory */
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            return $this->sendError('Product Category not found');
        }

        $productCategory = $this->productCategoryRepository->update($input, $id);

        return $this->sendResponse($productCategory->toArray(), 'ProductCategory updated successfully');
    }

    /**
     * Remove the specified ProductCategory from storage.
     * DELETE /product-categories/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var ProductCategory $productCategory */
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            return $this->sendError('Product Category not found');
        }

        $productCategory->delete();

        return $this->sendSuccess('Product Category deleted successfully');
    }
}
