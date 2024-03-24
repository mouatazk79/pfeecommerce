<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAttributeAPIRequest;
use App\Http\Requests\API\UpdateAttributeAPIRequest;
use App\Models\Attribute;
use App\Repositories\AttributeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class AttributeAPIController
 */
class AttributeAPIController extends AppBaseController
{
    private AttributeRepository $attributeRepository;

    public function __construct(AttributeRepository $attributeRepo)
    {
        $this->attributeRepository = $attributeRepo;
    }

    /**
     * Display a listing of the Attributes.
     * GET|HEAD /attributes
     */
    public function index(Request $request): JsonResponse
    {
        $attributes = $this->attributeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($attributes->toArray(), 'Attributes retrieved successfully');
    }

    /**
     * Store a newly created Attribute in storage.
     * POST /attributes
     */
    public function store(CreateAttributeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $attribute = $this->attributeRepository->create($input);

        return $this->sendResponse($attribute->toArray(), 'Attribute saved successfully');
    }

    /**
     * Display the specified Attribute.
     * GET|HEAD /attributes/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Attribute $attribute */
        $attribute = $this->attributeRepository->find($id);

        if (empty($attribute)) {
            return $this->sendError('Attribute not found');
        }

        return $this->sendResponse($attribute->toArray(), 'Attribute retrieved successfully');
    }

    /**
     * Update the specified Attribute in storage.
     * PUT/PATCH /attributes/{id}
     */
    public function update($id, UpdateAttributeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Attribute $attribute */
        $attribute = $this->attributeRepository->find($id);

        if (empty($attribute)) {
            return $this->sendError('Attribute not found');
        }

        $attribute = $this->attributeRepository->update($input, $id);

        return $this->sendResponse($attribute->toArray(), 'Attribute updated successfully');
    }

    /**
     * Remove the specified Attribute from storage.
     * DELETE /attributes/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Attribute $attribute */
        $attribute = $this->attributeRepository->find($id);

        if (empty($attribute)) {
            return $this->sendError('Attribute not found');
        }

        $attribute->delete();

        return $this->sendSuccess('Attribute deleted successfully');
    }
}
