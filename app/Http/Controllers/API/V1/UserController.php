<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Users\UserRequest;
use App\Http\Resources\ClinicCollection;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Group;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserServices;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    protected $repository = '';
    protected $service = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $repository, UserServices $userServices)
    {
        $this->repository = $repository;
        $this->service = $userServices;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->find($id);

        return $this->sendSuccessResponse(new UserResource($user));
    }

    public function search(Request $request)
    {
        $users = $this->repository->search($request->all());

        return new UserCollection($users);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UserCollection($this->repository->listUser());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Users\UserRequest  $request
     *
     * @param $id
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRequest $request)
    {
        try {
            $attributes = $request->validated();
            $user = $this->service->createUser($attributes);

            return $this->sendSuccessResponse($user, __('staff.info.messages._create_success'));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
    }

    /**
     * Update the resource in storage
     *
     * @param  \App\Http\Requests\Users\UserRequest  $request
     * @param $id
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $attributes = $request->validated();
            $this->service->updateUser($id, $attributes);

            return $this->sendSuccessResponse([], __('staff.info.messages._edit_success'));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // delete the user
        $user->delete();

        return $this->sendSuccessResponse([$user]);
    }

    public function getAllGroup()
    {
        return new GroupCollection(Group::orderBy('id')->get());
    }

    public function getAllGroupDefault()
    {
        return new GroupCollection(Group::orderBy('id')->get());
    }
}
