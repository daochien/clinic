<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\ClinicRequest;
use App\Http\Resources\ClinicCollection;
use App\Http\Resources\ClinicResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Clinic;
use App\Models\GroupUser;
use App\Repositories\ClinicRepository;
use App\Services\ClinicService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function all()
    {
        return new ClinicCollection($this->repository->getAll());
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

            return $this->sendSuccessResponse($clinic, __('clinic.info.messages._create_success'));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
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

        return $this->sendSuccessResponse(new ClinicResource($clinic->load(['users'])));
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

            return $this->sendSuccessResponse($result, __('clinic.info.messages._edit_success'));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    public function addUsers(Request $request, $clinicId)
    {
        try {
            $userIds = $request->get('user_ids');
            $this->service->addRelationUser($clinicId, $userIds);

            return $this->sendSuccessResponse([], __('clinic.clinic_users.messages._update_success'));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }

    }

    public function getUsers($clinicId)
    {
        $clinic = $this->repository->find($clinicId);

        return new UserCollection($clinic->users()->paginate(config('app.item_per_request')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = $this->service->delete($id);

            return $this->sendSuccessResponse($result);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    public function getAll()
    {
        return new ClinicCollection($this->repository->getAll());
    }
}
