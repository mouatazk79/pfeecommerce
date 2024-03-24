<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductVariationAttributeAPIRequest;
use App\Http\Requests\API\UpdateProductVariationAttributeAPIRequest;
use App\Models\ProductVariationAttribute;
use App\Repositories\ProductVariationAttributeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ProductVariationAttributeAPIController
 */
class ProductVariationAttributeAPIController extends AppBaseController
{
    private ProductVariationAttributeRepository $productVariationAttributeRepository;

    public function __construct(ProductVariationAttributeRepository $productVariationAttributeRepo)
    {
        $this->productVariationAttributeRepository = $productVariationAttributeRepo;
    }

    /**
     * Display a listing of the ProductVariationAttributes.
     * GET|HEAD /product-variation-attributes
     */
    public function index(Request $request): JsonResponse
    {
        $productVariationAttributes = $this->productVariationAttributeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($productVariationAttributes->toArray(), 'Product Variation Attributes retrieved successfully');
    }

    /**
     * Store a newly created ProductVariationAttribute in storage.
     * POST /product-variation-attributes
     */
    public function store(CreateProductVariationAttributeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $productVariationAttribute = $this->productVariationAttributeRepository->create($input);

        return $this->sendResponse($productVariationAttribute->toArray(), 'Product Variation Attribute saved successfully');
    }

    /**
     * Display the specified ProductVariationAttribute.
     * GET|HEAD /product-variation-attributes/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var ProductVariationAttribute $productVariationAttribute */
        $productVariationAttribute = $this->productVariationAttributeRepository->find($id);

        if (empty($productVariationAttribute)) {
            return $this->sendError('Product Variation Attribute not found');
        }

        return $this->sendResponse($productVariationAttribute->toArray(), 'Product Variation Attribute retrieved successfully');
    }

    /**
     * Update the specified ProductVariationAttribute in storage.
     * PUT/PATCH /product-variation-attributes/{id}
     */
    public function update($id, UpdateProductVariationAttributeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ProductVariationAttribute $productVariationAttribute */
        $productVariationAttribute = $this->productVariationAttributeRepository->find($id);

        if (empty($productVariationAttribute)) {
            return $this->sendError('Product Variation Attribute not found');
        }

        $productVariationAttribute = $this->productVariationAttributeRepository->update($input, $id);

        return $this->sendResponse($productVariationAttribute->toArray(), 'ProductVariationAttribute updated successfully');
    }

    /**
     * Remove the specified ProductVariationAttribute from storage.
     * DELETE /product-variation-attributes/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var ProductVariationAttribute $productVariationAttribute */
        $productVariationAttribute = $this->productVariationAttributeRepository->find($id);

        if (empty($productVariationAttribute)) {
            return $this->sendError('Product Variation Attribute not found');
        }

        $productVariationAttribute->delete();

        return $this->sendSuccess('Product Variation Attribute deleted successfully');
    }
}
