<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\ClinicRequest;
use App\Http\Resources\ClinicCollection;
use App\Http\Resources\ClinicResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Clinic;
use App\Repositories\ClinicRepository;
use App\Services\ClinicService;
use Illuminate\Http\Request;

class ClinicController extends BaseController
{
    protected $repository;

    protected $service;

    /**
     * Create a new controller instance.
     *
     * @param Clinic $clinic
     * @param ClinicRepository $clinicRepository
     */
    public function __construct(Clinic $clinic, ClinicRepository $clinicRepository, ClinicService $clinicService)
    {
        $this->repository = $clinicRepository;
        $this->service = $clinicService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clinics = $this->repository->get();

        return new ClinicCollection($clinics);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClinicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClinicRequest $request)
    {
        try {
            $clinic = $this->service->createClinic($request->validated());

            return $this->sendResponse($clinic);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getCode(), $exception->getMessage());
        }
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

        return $this->sendResponse(new ClinicResource($clinic->load(['users'])));
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
        try {
            $result = $this->repository->update($id, $request->validated());

            return $this->sendResponse($result);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getCode(), $exception->getMessage());
        }
    }

    public function addUsers(Request $request, $clinicId)
    {
        try {
            $userIds = $request->get('user_ids');
            $this->service->addRelationUser($clinicId, $userIds);

            return $this->sendResponse([]);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getCode(), $exception->getMessage());
        }

    }

    public function getUsers($clinicId)
    {
        $clinic = $this->repository->find($clinicId);

        return $this->sendResponse($clinic->users()->paginate(10));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->authorize('isAdmin');
            $result = $this->service->delete($id);

            return $this->sendResponse($result);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getCode(), $exception->getMessage());
        }
    }
}
