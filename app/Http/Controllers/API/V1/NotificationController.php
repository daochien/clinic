<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Notifications\NotificationRequest;
use App\Repositories\NotificationGroupRepository;
use App\Repositories\NotificationRepository;
use App\Services\NotificationService;
use App\Http\Resources\NotificationCollection;

class NotificationController extends BaseController
{
    protected $service;
    protected $repository;
    protected $repositoryGroup;

    public function __construct(
        NotificationService $notiService,
        NotificationRepository $notiRepository,
        NotificationGroupRepository $notiGroupRepository
    ) {
        $this->service = $notiService;
        $this->repository = $notiRepository;
        $this->repositoryGroup = $notiGroupRepository;
    }

    public function index()
    {
        $datas = $this->repository->get();
        return new NotificationCollection($datas);
    }

    public function all()
    {
        return new NotificationCollection($this->repository->getAll());
    }

    public function store(NotificationRequest $request)
    {
        try {
            $entity = $this->service->add($request);
            return $this->sendResponse($entity, 'Add notification successfuly');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getCode(), $exception->getMessage());
        }
    }

    public function show($id)
    {
        $data = $this->repository->show($id);
        return $this->sendResponse(new NotificationCollection($data->load(['users'])));
    }

    public function update(NotificationRequest $request, $id)
    {
        try {
            $result = $this->repository->update($id, $request->validated());

            return $this->sendResponse($result, 'Update notification successfuly');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getCode(), $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->service->delete($id);
            return $this->sendResponse($result);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getCode(), $exception->getMessage());
        }
    }

    public function members($id)
    {
        return $this->service->getMember($id);
    }

    public function getAll()
    {
        return new NotificationCollection($this->repository->getAll());
    }
}
