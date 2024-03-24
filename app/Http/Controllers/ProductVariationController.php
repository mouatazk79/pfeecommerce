<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductVariationRequest;
use App\Http\Requests\UpdateProductVariationRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProductVariationRepository;
use Illuminate\Http\Request;
use Flash;

class ProductVariationController extends AppBaseController
{
    /** @var ProductVariationRepository $productVariationRepository*/
    private $productVariationRepository;

    public function __construct(ProductVariationRepository $productVariationRepo)
    {
        $this->productVariationRepository = $productVariationRepo;
    }

    /**
     * Display a listing of the ProductVariation.
     */
    public function index(Request $request)
    {
        $productVariations = $this->productVariationRepository->paginate(10);

        return view('product_variations.index')
            ->with('productVariations', $productVariations);
    }

    /**
     * Show the form for creating a new ProductVariation.
     */
    public function create()
    {
        return view('product_variations.create');
    }

    /**
     * Store a newly created ProductVariation in storage.
     */
    public function store(CreateProductVariationRequest $request)
    {
        $input = $request->all();

        $productVariation = $this->productVariationRepository->create($input);

        Flash::success('Product Variation saved successfully.');

        return redirect(route('productVariations.index'));
    }

    /**
     * Display the specified ProductVariation.
     */
    public function show($id)
    {
        $productVariation = $this->productVariationRepository->find($id);

        if (empty($productVariation)) {
            Flash::error('Product Variation not found');

            return redirect(route('productVariations.index'));
        }

        return view('product_variations.show')->with('productVariation', $productVariation);
    }

    /**
     * Show the form for editing the specified ProductVariation.
     */
    public function edit($id)
    {
        $productVariation = $this->productVariationRepository->find($id);

        if (empty($productVariation)) {
            Flash::error('Product Variation not found');

            return redirect(route('productVariations.index'));
        }

        return view('product_variations.edit')->with('productVariation', $productVariation);
    }

    /**
     * Update the specified ProductVariation in storage.
     */
    public function update($id, UpdateProductVariationRequest $request)
    {
        $productVariation = $this->productVariationRepository->find($id);

        if (empty($productVariation)) {
            Flash::error('Product Variation not found');

            return redirect(route('productVariations.index'));
        }

        $productVariation = $this->productVariationRepository->update($request->all(), $id);

        Flash::success('Product Variation updated successfully.');

        return redirect(route('productVariations.index'));
    }

    /**
     * Remove the specified ProductVariation from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $productVariation = $this->productVariationRepository->find($id);

        if (empty($productVariation)) {
            Flash::error('Product Variation not found');

            return redirect(route('productVariations.index'));
        }

        $this->productVariationRepository->delete($id);

        Flash::success('Product Variation deleted successfully.');

        return redirect(route('productVariations.index'));
    }
}
