<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderStatusChangeRequest;
use App\Http\Requests\UpdateOrderStatusChangeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\OrderStatusChangeRepository;
use Illuminate\Http\Request;
use Flash;

class OrderStatusChangeController extends AppBaseController
{
    /** @var OrderStatusChangeRepository $orderStatusChangeRepository*/
    private $orderStatusChangeRepository;

    public function __construct(OrderStatusChangeRepository $orderStatusChangeRepo)
    {
        $this->orderStatusChangeRepository = $orderStatusChangeRepo;
    }

    /**
     * Display a listing of the OrderStatusChange.
     */
    public function index(Request $request)
    {
        $orderStatusChanges = $this->orderStatusChangeRepository->paginate(10);

        return view('order_status_changes.index')
            ->with('orderStatusChanges', $orderStatusChanges);
    }

    /**
     * Show the form for creating a new OrderStatusChange.
     */
    public function create()
    {
        return view('order_status_changes.create');
    }

    /**
     * Store a newly created OrderStatusChange in storage.
     */
    public function store(CreateOrderStatusChangeRequest $request)
    {
        $input = $request->all();

        $orderStatusChange = $this->orderStatusChangeRepository->create($input);

        Flash::success('Order Status Change saved successfully.');

        return redirect(route('orderStatusChanges.index'));
    }

    /**
     * Display the specified OrderStatusChange.
     */
    public function show($id)
    {
        $orderStatusChange = $this->orderStatusChangeRepository->find($id);

        if (empty($orderStatusChange)) {
            Flash::error('Order Status Change not found');

            return redirect(route('orderStatusChanges.index'));
        }

        return view('order_status_changes.show')->with('orderStatusChange', $orderStatusChange);
    }

    /**
     * Show the form for editing the specified OrderStatusChange.
     */
    public function edit($id)
    {
        $orderStatusChange = $this->orderStatusChangeRepository->find($id);

        if (empty($orderStatusChange)) {
            Flash::error('Order Status Change not found');

            return redirect(route('orderStatusChanges.index'));
        }

        return view('order_status_changes.edit')->with('orderStatusChange', $orderStatusChange);
    }

    /**
     * Update the specified OrderStatusChange in storage.
     */
    public function update($id, UpdateOrderStatusChangeRequest $request)
    {
        $orderStatusChange = $this->orderStatusChangeRepository->find($id);

        if (empty($orderStatusChange)) {
            Flash::error('Order Status Change not found');

            return redirect(route('orderStatusChanges.index'));
        }

        $orderStatusChange = $this->orderStatusChangeRepository->update($request->all(), $id);

        Flash::success('Order Status Change updated successfully.');

        return redirect(route('orderStatusChanges.index'));
    }

    /**
     * Remove the specified OrderStatusChange from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $orderStatusChange = $this->orderStatusChangeRepository->find($id);

        if (empty($orderStatusChange)) {
            Flash::error('Order Status Change not found');

            return redirect(route('orderStatusChanges.index'));
        }

        $this->orderStatusChangeRepository->delete($id);

        Flash::success('Order Status Change deleted successfully.');

        return redirect(route('orderStatusChanges.index'));
    }
}
