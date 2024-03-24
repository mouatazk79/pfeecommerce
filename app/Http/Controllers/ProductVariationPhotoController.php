<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductVariationPhotoRequest;
use App\Http\Requests\UpdateProductVariationPhotoRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProductVariationPhotoRepository;
use Illuminate\Http\Request;
use Flash;

class ProductVariationPhotoController extends AppBaseController
{
    /** @var ProductVariationPhotoRepository $productVariationPhotoRepository*/
    private $productVariationPhotoRepository;

    public function __construct(ProductVariationPhotoRepository $productVariationPhotoRepo)
    {
        $this->productVariationPhotoRepository = $productVariationPhotoRepo;
    }

    /**
     * Display a listing of the ProductVariationPhoto.
     */
    public function index(Request $request)
    {
        $productVariationPhotos = $this->productVariationPhotoRepository->paginate(10);

        return view('product_variation_photos.index')
            ->with('productVariationPhotos', $productVariationPhotos);
    }

    /**
     * Show the form for creating a new ProductVariationPhoto.
     */
    public function create()
    {
        return view('product_variation_photos.create');
    }

    /**
     * Store a newly created ProductVariationPhoto in storage.
     */
    public function store(CreateProductVariationPhotoRequest $request)
    {
        $input = $request->all();

        $productVariationPhoto = $this->productVariationPhotoRepository->create($input);

        Flash::success('Product Variation Photo saved successfully.');

        return redirect(route('productVariationPhotos.index'));
    }

    /**
     * Display the specified ProductVariationPhoto.
     */
    public function show($id)
    {
        $productVariationPhoto = $this->productVariationPhotoRepository->find($id);

        if (empty($productVariationPhoto)) {
            Flash::error('Product Variation Photo not found');

            return redirect(route('productVariationPhotos.index'));
        }

        return view('product_variation_photos.show')->with('productVariationPhoto', $productVariationPhoto);
    }

    /**
     * Show the form for editing the specified ProductVariationPhoto.
     */
    public function edit($id)
    {
        $productVariationPhoto = $this->productVariationPhotoRepository->find($id);

        if (empty($productVariationPhoto)) {
            Flash::error('Product Variation Photo not found');

            return redirect(route('productVariationPhotos.index'));
        }

        return view('product_variation_photos.edit')->with('productVariationPhoto', $productVariationPhoto);
    }

    /**
     * Update the specified ProductVariationPhoto in storage.
     */
    public function update($id, UpdateProductVariationPhotoRequest $request)
    {
        $productVariationPhoto = $this->productVariationPhotoRepository->find($id);

        if (empty($productVariationPhoto)) {
            Flash::error('Product Variation Photo not found');

            return redirect(route('productVariationPhotos.index'));
        }

        $productVariationPhoto = $this->productVariationPhotoRepository->update($request->all(), $id);

        Flash::success('Product Variation Photo updated successfully.');

        return redirect(route('productVariationPhotos.index'));
    }

    /**
     * Remove the specified ProductVariationPhoto from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $productVariationPhoto = $this->productVariationPhotoRepository->find($id);

        if (empty($productVariationPhoto)) {
            Flash::error('Product Variation Photo not found');

            return redirect(route('productVariationPhotos.index'));
        }

        $this->productVariationPhotoRepository->delete($id);

        Flash::success('Product Variation Photo deleted successfully.');

        return redirect(route('productVariationPhotos.index'));
    }
}
