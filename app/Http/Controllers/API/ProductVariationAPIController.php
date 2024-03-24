<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductVariationAPIRequest;
use App\Http\Requests\API\UpdateProductVariationAPIRequest;
use App\Models\ProductVariation;
use App\Repositories\ProductVariationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ProductVariationAPIController
 */
class ProductVariationAPIController extends AppBaseController
{
    private ProductVariationRepository $productVariationRepository;

    public function __construct(ProductVariationRepository $productVariationRepo)
    {
        $this->productVariationRepository = $productVariationRepo;
    }

    /**
     * Display a listing of the ProductVariations.
     * GET|HEAD /product-variations
     */
    public function index(Request $request): JsonResponse
    {
        $productVariations = $this->productVariationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($productVariations->toArray(), 'Product Variations retrieved successfully');
    }

    /**
     * Store a newly created ProductVariation in storage.
     * POST /product-variations
     */
    public function store(CreateProductVariationAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $productVariation = $this->productVariationRepository->create($input);

        return $this->sendResponse($productVariation->toArray(), 'Product Variation saved successfully');
    }

    /**
     * Display the specified ProductVariation.
     * GET|HEAD /product-variations/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var ProductVariation $productVariation */
        $productVariation = $this->productVariationRepository->find($id);

        if (empty($productVariation)) {
            return $this->sendError('Product Variation not found');
        }

        return $this->sendResponse($productVariation->toArray(), 'Product Variation retrieved successfully');
    }

    /**
     * Update the specified ProductVariation in storage.
     * PUT/PATCH /product-variations/{id}
     */
    public function update($id, UpdateProductVariationAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ProductVariation $productVariation */
        $productVariation = $this->productVariationRepository->find($id);

        if (empty($productVariation)) {
            return $this->sendError('Product Variation not found');
        }

        $productVariation = $this->productVariationRepository->update($input, $id);

        return $this->sendResponse($productVariation->toArray(), 'ProductVariation updated successfully');
    }

    /**
     * Remove the specified ProductVariation from storage.
     * DELETE /product-variations/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var ProductVariation $productVariation */
        $productVariation = $this->productVariationRepository->find($id);

        if (empty($productVariation)) {
            return $this->sendError('Product Variation not found');
        }

        $productVariation->delete();

        return $this->sendSuccess('Product Variation deleted successfully');
    }
}
