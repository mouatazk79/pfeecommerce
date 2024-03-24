<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderStatusChangeAPIRequest;
use App\Http\Requests\API\UpdateOrderStatusChangeAPIRequest;
use App\Models\OrderStatusChange;
use App\Repositories\OrderStatusChangeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class OrderStatusChangeAPIController
 */
class OrderStatusChangeAPIController extends AppBaseController
{
    private OrderStatusChangeRepository $orderStatusChangeRepository;

    public function __construct(OrderStatusChangeRepository $orderStatusChangeRepo)
    {
        $this->orderStatusChangeRepository = $orderStatusChangeRepo;
    }

    /**
     * Display a listing of the OrderStatusChanges.
     * GET|HEAD /order-status-changes
     */
    public function index(Request $request): JsonResponse
    {
        $orderStatusChanges = $this->orderStatusChangeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($orderStatusChanges->toArray(), 'Order Status Changes retrieved successfully');
    }

    /**
     * Store a newly created OrderStatusChange in storage.
     * POST /order-status-changes
     */
    public function store(CreateOrderStatusChangeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $orderStatusChange = $this->orderStatusChangeRepository->create($input);

        return $this->sendResponse($orderStatusChange->toArray(), 'Order Status Change saved successfully');
    }

    /**
     * Display the specified OrderStatusChange.
     * GET|HEAD /order-status-changes/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var OrderStatusChange $orderStatusChange */
        $orderStatusChange = $this->orderStatusChangeRepository->find($id);

        if (empty($orderStatusChange)) {
            return $this->sendError('Order Status Change not found');
        }

        return $this->sendResponse($orderStatusChange->toArray(), 'Order Status Change retrieved successfully');
    }

    /**
     * Update the specified OrderStatusChange in storage.
     * PUT/PATCH /order-status-changes/{id}
     */
    public function update($id, UpdateOrderStatusChangeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var OrderStatusChange $orderStatusChange */
        $orderStatusChange = $this->orderStatusChangeRepository->find($id);

        if (empty($orderStatusChange)) {
            return $this->sendError('Order Status Change not found');
        }

        $orderStatusChange = $this->orderStatusChangeRepository->update($input, $id);

        return $this->sendResponse($orderStatusChange->toArray(), 'OrderStatusChange updated successfully');
    }

    /**
     * Remove the specified OrderStatusChange from storage.
     * DELETE /order-status-changes/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var OrderStatusChange $orderStatusChange */
        $orderStatusChange = $this->orderStatusChangeRepository->find($id);

        if (empty($orderStatusChange)) {
            return $this->sendError('Order Status Change not found');
        }

        $orderStatusChange->delete();

        return $this->sendSuccess('Order Status Change deleted successfully');
    }
}
