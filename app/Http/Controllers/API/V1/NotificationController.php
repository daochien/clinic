<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Notifications\NotificationRequest;
use App\Http\Requests\Notifications\SearchNotificationRequest;
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
            $id = 0;
            if (isset($request['notification_id'])) {
                $id = $request['notification_id'];
            }

            if ($id > 0) {
                return $this->sendResponse($this->service->update($request, $id), __('notification.create_successfuly'));
            }

            $entity = $this->service->add($request);
            return $this->sendResponse($entity,  __('notification.update_successfuly'));
        } catch (\Exception $exception) {
            return $this->sendError($exception->getCode(), $exception->getMessage());
        }
    }

    public function show($id)
    {
        $data = $this->repository->show($id);
        return $this->sendResponse($data);
    }

    public function update(NotificationRequest $request, $id)
    {
        try {
            $result = $this->repository->update($id, $request->validated());

            return $this->sendResponse($result, __('notification.update_successfuly'));
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

    public function search(SearchNotificationRequest $request)
    {
        try {
            $datas = $this->service->search($request);
            return new NotificationCollection($datas);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getCode(), $exception->getMessage());
        }
    }
}
