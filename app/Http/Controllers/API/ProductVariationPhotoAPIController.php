<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductVariationPhotoAPIRequest;
use App\Http\Requests\API\UpdateProductVariationPhotoAPIRequest;
use App\Models\ProductVariationPhoto;
use App\Repositories\ProductVariationPhotoRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ProductVariationPhotoAPIController
 */
class ProductVariationPhotoAPIController extends AppBaseController
{
    private ProductVariationPhotoRepository $productVariationPhotoRepository;

    public function __construct(ProductVariationPhotoRepository $productVariationPhotoRepo)
    {
        $this->productVariationPhotoRepository = $productVariationPhotoRepo;
    }

    /**
     * Display a listing of the ProductVariationPhotos.
     * GET|HEAD /product-variation-photos
     */
    public function index(Request $request): JsonResponse
    {
        $productVariationPhotos = $this->productVariationPhotoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($productVariationPhotos->toArray(), 'Product Variation Photos retrieved successfully');
    }

    /**
     * Store a newly created ProductVariationPhoto in storage.
     * POST /product-variation-photos
     */
    public function store(CreateProductVariationPhotoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $productVariationPhoto = $this->productVariationPhotoRepository->create($input);

        return $this->sendResponse($productVariationPhoto->toArray(), 'Product Variation Photo saved successfully');
    }

    /**
     * Display the specified ProductVariationPhoto.
     * GET|HEAD /product-variation-photos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var ProductVariationPhoto $productVariationPhoto */
        $productVariationPhoto = $this->productVariationPhotoRepository->find($id);

        if (empty($productVariationPhoto)) {
            return $this->sendError('Product Variation Photo not found');
        }

        return $this->sendResponse($productVariationPhoto->toArray(), 'Product Variation Photo retrieved successfully');
    }

    /**
     * Update the specified ProductVariationPhoto in storage.
     * PUT/PATCH /product-variation-photos/{id}
     */
    public function update($id, UpdateProductVariationPhotoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ProductVariationPhoto $productVariationPhoto */
        $productVariationPhoto = $this->productVariationPhotoRepository->find($id);

        if (empty($productVariationPhoto)) {
            return $this->sendError('Product Variation Photo not found');
        }

        $productVariationPhoto = $this->productVariationPhotoRepository->update($input, $id);

        return $this->sendResponse($productVariationPhoto->toArray(), 'ProductVariationPhoto updated successfully');
    }

    /**
     * Remove the specified ProductVariationPhoto from storage.
     * DELETE /product-variation-photos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var ProductVariationPhoto $productVariationPhoto */
        $productVariationPhoto = $this->productVariationPhotoRepository->find($id);

        if (empty($productVariationPhoto)) {
            return $this->sendError('Product Variation Photo not found');
        }

        $productVariationPhoto->delete();

        return $this->sendSuccess('Product Variation Photo deleted successfully');
    }
}
