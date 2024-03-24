<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductVariationAttributeRequest;
use App\Http\Requests\UpdateProductVariationAttributeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProductVariationAttributeRepository;
use Illuminate\Http\Request;
use Flash;

class ProductVariationAttributeController extends AppBaseController
{
    /** @var ProductVariationAttributeRepository $productVariationAttributeRepository*/
    private $productVariationAttributeRepository;

    public function __construct(ProductVariationAttributeRepository $productVariationAttributeRepo)
    {
        $this->productVariationAttributeRepository = $productVariationAttributeRepo;
    }

    /**
     * Display a listing of the ProductVariationAttribute.
     */
    public function index(Request $request)
    {
        $productVariationAttributes = $this->productVariationAttributeRepository->paginate(10);

        return view('product_variation_attributes.index')
            ->with('productVariationAttributes', $productVariationAttributes);
    }

    /**
     * Show the form for creating a new ProductVariationAttribute.
     */
    public function create()
    {
        return view('product_variation_attributes.create');
    }

    /**
     * Store a newly created ProductVariationAttribute in storage.
     */
    public function store(CreateProductVariationAttributeRequest $request)
    {
        $input = $request->all();

        $productVariationAttribute = $this->productVariationAttributeRepository->create($input);

        Flash::success('Product Variation Attribute saved successfully.');

        return redirect(route('productVariationAttributes.index'));
    }

    /**
     * Display the specified ProductVariationAttribute.
     */
    public function show($id)
    {
        $productVariationAttribute = $this->productVariationAttributeRepository->find($id);

        if (empty($productVariationAttribute)) {
            Flash::error('Product Variation Attribute not found');

            return redirect(route('productVariationAttributes.index'));
        }

        return view('product_variation_attributes.show')->with('productVariationAttribute', $productVariationAttribute);
    }

    /**
     * Show the form for editing the specified ProductVariationAttribute.
     */
    public function edit($id)
    {
        $productVariationAttribute = $this->productVariationAttributeRepository->find($id);

        if (empty($productVariationAttribute)) {
            Flash::error('Product Variation Attribute not found');

            return redirect(route('productVariationAttributes.index'));
        }

        return view('product_variation_attributes.edit')->with('productVariationAttribute', $productVariationAttribute);
    }

    /**
     * Update the specified ProductVariationAttribute in storage.
     */
    public function update($id, UpdateProductVariationAttributeRequest $request)
    {
        $productVariationAttribute = $this->productVariationAttributeRepository->find($id);

        if (empty($productVariationAttribute)) {
            Flash::error('Product Variation Attribute not found');

            return redirect(route('productVariationAttributes.index'));
        }

        $productVariationAttribute = $this->productVariationAttributeRepository->update($request->all(), $id);

        Flash::success('Product Variation Attribute updated successfully.');

        return redirect(route('productVariationAttributes.index'));
    }

    /**
     * Remove the specified ProductVariationAttribute from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $productVariationAttribute = $this->productVariationAttributeRepository->find($id);

        if (empty($productVariationAttribute)) {
            Flash::error('Product Variation Attribute not found');

            return redirect(route('productVariationAttributes.index'));
        }

        $this->productVariationAttributeRepository->delete($id);

        Flash::success('Product Variation Attribute deleted successfully.');

        return redirect(route('productVariationAttributes.index'));
    }
}
