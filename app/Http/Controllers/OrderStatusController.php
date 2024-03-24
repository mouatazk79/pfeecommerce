<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderStatusRequest;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\OrderStatusRepository;
use Illuminate\Http\Request;
use Flash;

class OrderStatusController extends AppBaseController
{
    /** @var OrderStatusRepository $orderStatusRepository*/
    private $orderStatusRepository;

    public function __construct(OrderStatusRepository $orderStatusRepo)
    {
        $this->orderStatusRepository = $orderStatusRepo;
    }

    /**
     * Display a listing of the OrderStatus.
     */
    public function index(Request $request)
    {
        $orderStatuses = $this->orderStatusRepository->paginate(10);

        return view('order_statuses.index')
            ->with('orderStatuses', $orderStatuses);
    }

    /**
     * Show the form for creating a new OrderStatus.
     */
    public function create()
    {
        return view('order_statuses.create');
    }

    /**
     * Store a newly created OrderStatus in storage.
     */
    public function store(CreateOrderStatusRequest $request)
    {
        $input = $request->all();

        $orderStatus = $this->orderStatusRepository->create($input);

        Flash::success('Order Status saved successfully.');

        return redirect(route('orderStatuses.index'));
    }

    /**
     * Display the specified OrderStatus.
     */
    public function show($id)
    {
        $orderStatus = $this->orderStatusRepository->find($id);

        if (empty($orderStatus)) {
            Flash::error('Order Status not found');

            return redirect(route('orderStatuses.index'));
        }

        return view('order_statuses.show')->with('orderStatus', $orderStatus);
    }

    /**
     * Show the form for editing the specified OrderStatus.
     */
    public function edit($id)
    {
        $orderStatus = $this->orderStatusRepository->find($id);

        if (empty($orderStatus)) {
            Flash::error('Order Status not found');

            return redirect(route('orderStatuses.index'));
        }

        return view('order_statuses.edit')->with('orderStatus', $orderStatus);
    }

    /**
     * Update the specified OrderStatus in storage.
     */
    public function update($id, UpdateOrderStatusRequest $request)
    {
        $orderStatus = $this->orderStatusRepository->find($id);

        if (empty($orderStatus)) {
            Flash::error('Order Status not found');

            return redirect(route('orderStatuses.index'));
        }

        $orderStatus = $this->orderStatusRepository->update($request->all(), $id);

        Flash::success('Order Status updated successfully.');

        return redirect(route('orderStatuses.index'));
    }

    /**
     * Remove the specified OrderStatus from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $orderStatus = $this->orderStatusRepository->find($id);

        if (empty($orderStatus)) {
            Flash::error('Order Status not found');

            return redirect(route('orderStatuses.index'));
        }

        $this->orderStatusRepository->delete($id);

        Flash::success('Order Status deleted successfully.');

        return redirect(route('orderStatuses.index'));
    }
}
