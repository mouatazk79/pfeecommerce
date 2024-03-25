<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController
{
    private  $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the Product.
     */
    public function index(Request $request)
    {
        $products = $this->productRepository->paginate(10);

        return view('products.index')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new Product.
     */
    public function create()
    {
        return view('products.index');
    }

    /**
     * Store a newly created Product in storage.
     */
    public function store(CreateProductRequest $request): \Illuminate\Http\RedirectResponse
    {

        $validatedData = $request->validated();

        $product = $this->productRepository->create($validatedData);

        return redirect()->route('products.create')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified Product.
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     */
    public function edit($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('products.edit')->with('product', $product);
    }

    /**
     * Update the specified Product in storage.
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        $product = $this->productRepository->update($request->all(), $id);

        Flash::success('Product updated successfully.');

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect(route('products.index'));
    }
}
