<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderProductRequest;
use App\Http\Requests\UpdateOrderProductRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\OrderProductRepository;
use Illuminate\Http\Request;
use Flash;

class OrderProductController extends AppBaseController
{
    /** @var OrderProductRepository $orderProductRepository*/
    private $orderProductRepository;

    public function __construct(OrderProductRepository $orderProductRepo)
    {
        $this->orderProductRepository = $orderProductRepo;
    }

    /**
     * Display a listing of the OrderProduct.
     */
    public function index(Request $request)
    {
        $orderProducts = $this->orderProductRepository->paginate(10);

        return view('order_products.index')
            ->with('orderProducts', $orderProducts);
    }

    /**
     * Show the form for creating a new OrderProduct.
     */
    public function create()
    {
        return view('order_products.create');
    }

    /**
     * Store a newly created OrderProduct in storage.
     */
    public function store(CreateOrderProductRequest $request)
    {
        $input = $request->all();

        $orderProduct = $this->orderProductRepository->create($input);

        Flash::success('Order Product saved successfully.');

        return redirect(route('orderProducts.index'));
    }

    /**
     * Display the specified OrderProduct.
     */
    public function show($id)
    {
        $orderProduct = $this->orderProductRepository->find($id);

        if (empty($orderProduct)) {
            Flash::error('Order Product not found');

            return redirect(route('orderProducts.index'));
        }

        return view('order_products.show')->with('orderProduct', $orderProduct);
    }

    /**
     * Show the form for editing the specified OrderProduct.
     */
    public function edit($id)
    {
        $orderProduct = $this->orderProductRepository->find($id);

        if (empty($orderProduct)) {
            Flash::error('Order Product not found');

            return redirect(route('orderProducts.index'));
        }

        return view('order_products.edit')->with('orderProduct', $orderProduct);
    }

    /**
     * Update the specified OrderProduct in storage.
     */
    public function update($id, UpdateOrderProductRequest $request)
    {
        $orderProduct = $this->orderProductRepository->find($id);

        if (empty($orderProduct)) {
            Flash::error('Order Product not found');

            return redirect(route('orderProducts.index'));
        }

        $orderProduct = $this->orderProductRepository->update($request->all(), $id);

        Flash::success('Order Product updated successfully.');

        return redirect(route('orderProducts.index'));
    }

    /**
     * Remove the specified OrderProduct from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $orderProduct = $this->orderProductRepository->find($id);

        if (empty($orderProduct)) {
            Flash::error('Order Product not found');

            return redirect(route('orderProducts.index'));
        }

        $this->orderProductRepository->delete($id);

        Flash::success('Order Product deleted successfully.');

        return redirect(route('orderProducts.index'));
    }
}
