<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\StoreRepository;
use Illuminate\Http\Request;
use Flash;

class StoreController extends AppBaseController
{
    /** @var StoreRepository $storeRepository*/
    private $storeRepository;

    public function __construct(StoreRepository $storeRepo)
    {
        $this->storeRepository = $storeRepo;
    }

    /**
     * Display a listing of the Store.
     */
    public function index(Request $request)
    {
        $stores = $this->storeRepository->paginate(10);

        return view('stores.index')
            ->with('stores', $stores);
    }

    /**
     * Show the form for creating a new Store.
     */
    public function create()
    {
        return view('stores.create');
    }

    /**
     * Store a newly created Store in storage.
     */
    public function store(CreateStoreRequest $request)
    {
        $input = $request->all();

        $store = $this->storeRepository->create($input);

        Flash::success('Store saved successfully.');

        return redirect(route('stores.index'));
    }

    /**
     * Display the specified Store.
     */
    public function show($id)
    {
        $store = $this->storeRepository->find($id);

        if (empty($store)) {
            Flash::error('Store not found');

            return redirect(route('stores.index'));
        }

        return view('stores.show')->with('store', $store);
    }

    /**
     * Show the form for editing the specified Store.
     */
    public function edit($id)
    {
        $store = $this->storeRepository->find($id);

        if (empty($store)) {
            Flash::error('Store not found');

            return redirect(route('stores.index'));
        }

        return view('stores.edit')->with('store', $store);
    }

    /**
     * Update the specified Store in storage.
     */
    public function update($id, UpdateStoreRequest $request)
    {
        $store = $this->storeRepository->find($id);

        if (empty($store)) {
            Flash::error('Store not found');

            return redirect(route('stores.index'));
        }

        $store = $this->storeRepository->update($request->all(), $id);

        Flash::success('Store updated successfully.');

        return redirect(route('stores.index'));
    }

    /**
     * Remove the specified Store from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $store = $this->storeRepository->find($id);

        if (empty($store)) {
            Flash::error('Store not found');

            return redirect(route('stores.index'));
        }

        $this->storeRepository->delete($id);

        Flash::success('Store deleted successfully.');

        return redirect(route('stores.index'));
    }
}
