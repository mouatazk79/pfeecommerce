<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStoreProductRequest;
use App\Http\Requests\UpdateStoreProductRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\StoreProductRepository;
use Illuminate\Http\Request;
use Flash;

class StoreProductController extends AppBaseController
{
    /** @var StoreProductRepository $storeProductRepository*/
    private $storeProductRepository;

    public function __construct(StoreProductRepository $storeProductRepo)
    {
        $this->storeProductRepository = $storeProductRepo;
    }

    /**
     * Display a listing of the StoreProduct.
     */
    public function index(Request $request)
    {
        $storeProducts = $this->storeProductRepository->paginate(10);

        return view('store_products.index')
            ->with('storeProducts', $storeProducts);
    }

    /**
     * Show the form for creating a new StoreProduct.
     */
    public function create()
    {
        return view('store_products.create');
    }

    /**
     * Store a newly created StoreProduct in storage.
     */
    public function store(CreateStoreProductRequest $request)
    {
        $input = $request->all();

        $storeProduct = $this->storeProductRepository->create($input);

        Flash::success('Store Product saved successfully.');

        return redirect(route('storeProducts.index'));
    }

    /**
     * Display the specified StoreProduct.
     */
    public function show($id)
    {
        $storeProduct = $this->storeProductRepository->find($id);

        if (empty($storeProduct)) {
            Flash::error('Store Product not found');

            return redirect(route('storeProducts.index'));
        }

        return view('store_products.show')->with('storeProduct', $storeProduct);
    }

    /**
     * Show the form for editing the specified StoreProduct.
     */
    public function edit($id)
    {
        $storeProduct = $this->storeProductRepository->find($id);

        if (empty($storeProduct)) {
            Flash::error('Store Product not found');

            return redirect(route('storeProducts.index'));
        }

        return view('store_products.edit')->with('storeProduct', $storeProduct);
    }

    /**
     * Update the specified StoreProduct in storage.
     */
    public function update($id, UpdateStoreProductRequest $request)
    {
        $storeProduct = $this->storeProductRepository->find($id);

        if (empty($storeProduct)) {
            Flash::error('Store Product not found');

            return redirect(route('storeProducts.index'));
        }

        $storeProduct = $this->storeProductRepository->update($request->all(), $id);

        Flash::success('Store Product updated successfully.');

        return redirect(route('storeProducts.index'));
    }

    /**
     * Remove the specified StoreProduct from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $storeProduct = $this->storeProductRepository->find($id);

        if (empty($storeProduct)) {
            Flash::error('Store Product not found');

            return redirect(route('storeProducts.index'));
        }

        $this->storeProductRepository->delete($id);

        Flash::success('Store Product deleted successfully.');

        return redirect(route('storeProducts.index'));
    }
}
