<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Notifications\NotificationRequest;
use App\Http\Requests\Notifications\SearchNotificationRequest;
use App\Models\Notification;
use App\Models\User;
use App\Repositories\NotificationGroupRepository;
use App\Repositories\NotificationRepository;
use App\Services\NotificationService;
use App\Http\Resources\NotificationCollection;
use App\Http\Resources\NotificationUserCollection;
use Illuminate\Http\Request;

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
                return $this->sendSuccessResponse($this->service->update($request, $id), __('notification.create_successfuly'));
            }

            $entity = $this->service->add($request);
            return $this->sendSuccessResponse($entity,  __('notification.update_successfuly'));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    public function publish(Request $request)
    {
        return $this->service->publish($request->get('id'));
    }

    public function show($id)
    {
        $data = $this->repository->show($id);
        return $this->sendSuccessResponse($data);
    }

    public function update(NotificationRequest $request, $id)
    {
        try {
            $result = $this->repository->update($id, $request->validated());

            return $this->sendSuccessResponse($result, __('notification.update_successfuly'));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $result = $this->service->delete($id);
            return $this->sendSuccessResponse($result);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    public function members($id)
    {
        $datas =  $this->service->getMember($id);
        return new NotificationUserCollection($datas);
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
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    public function detailSearch(SearchNotificationRequest $request)
    {
        try {
            $datas = $this->service->detailSearch($request);
            return new NotificationUserCollection($datas);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    public function fetch(Request $request)
    {
        try {
            $filters['user_id'] = $request->get('user_id');
            $filters['from'] = $request->get('from') ?? 0;
            $data = $this->service->fetch($filters);
            return response()->json($data);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }

    }
}
