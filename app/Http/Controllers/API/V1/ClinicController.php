<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\ClinicRequest;
use App\Models\Clinic;
use App\Repositories\ClinicRepository;

class ClinicController extends BaseController
{

    protected $clinic = '';

    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @param Clinic $clinic
     * @param ClinicRepository $clinicRepository
     */
    public function __construct(Clinic $clinic, ClinicRepository $clinicRepository)
    {
        $this->clinic = $clinic;
        $this->repository = $clinicRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinics = $this->repository->get();

        return $this->sendResponse($clinics, 'Item list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClinicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClinicRequest $request)
    {
        $clinic = $this->repository->create($request->validated());

        return $this->sendResponse($clinic, 'Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clinic = $this->repository->show($id);

        return $this->sendResponse($clinic, 'Item details');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClinicRequest  $request
     * @param  Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function update(ClinicRequest $request, $id)
    {
        $product = $this->clinic->findOrFail($id);
        $product->update($request->all());

        return $this->sendResponse($product, 'Item information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $clinic = $this->clinic->findOrFail($id);
        $clinic->delete();

        return $this->sendResponse($clinic, 'Item has been Deleted');
    }
}
