<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderStatusAPIRequest;
use App\Http\Requests\API\UpdateOrderStatusAPIRequest;
use App\Models\OrderStatus;
use App\Repositories\OrderStatusRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class OrderStatusAPIController
 */
class OrderStatusAPIController extends AppBaseController
{
    private OrderStatusRepository $orderStatusRepository;

    public function __construct(OrderStatusRepository $orderStatusRepo)
    {
        $this->orderStatusRepository = $orderStatusRepo;
    }

    /**
     * Display a listing of the OrderStatuses.
     * GET|HEAD /order-statuses
     */
    public function index(Request $request): JsonResponse
    {
        $orderStatuses = $this->orderStatusRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($orderStatuses->toArray(), 'Order Statuses retrieved successfully');
    }

    /**
     * Store a newly created OrderStatus in storage.
     * POST /order-statuses
     */
    public function store(CreateOrderStatusAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $orderStatus = $this->orderStatusRepository->create($input);

        return $this->sendResponse($orderStatus->toArray(), 'Order Status saved successfully');
    }

    /**
     * Display the specified OrderStatus.
     * GET|HEAD /order-statuses/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var OrderStatus $orderStatus */
        $orderStatus = $this->orderStatusRepository->find($id);

        if (empty($orderStatus)) {
            return $this->sendError('Order Status not found');
        }

        return $this->sendResponse($orderStatus->toArray(), 'Order Status retrieved successfully');
    }

    /**
     * Update the specified OrderStatus in storage.
     * PUT/PATCH /order-statuses/{id}
     */
    public function update($id, UpdateOrderStatusAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var OrderStatus $orderStatus */
        $orderStatus = $this->orderStatusRepository->find($id);

        if (empty($orderStatus)) {
            return $this->sendError('Order Status not found');
        }

        $orderStatus = $this->orderStatusRepository->update($input, $id);

        return $this->sendResponse($orderStatus->toArray(), 'OrderStatus updated successfully');
    }

    /**
     * Remove the specified OrderStatus from storage.
     * DELETE /order-statuses/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var OrderStatus $orderStatus */
        $orderStatus = $this->orderStatusRepository->find($id);

        if (empty($orderStatus)) {
            return $this->sendError('Order Status not found');
        }

        $orderStatus->delete();

        return $this->sendSuccess('Order Status deleted successfully');
    }
}
