<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Notifications\NotificationRequest;
use App\Http\Requests\Notifications\SearchNotificationRequest;
use App\Http\Resources\NotificationFetchCollection;
use App\Http\Resources\NotificationFetchResource;
use App\Models\Notification;
use App\Models\User;
use App\Repositories\NotificationGroupRepository;
use App\Repositories\NotificationRepository;
use App\Services\NotificationService;
use App\Http\Resources\NotificationCollection;
use App\Http\Resources\NotificationUserCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class NotificationController extends BaseController
{
    protected $service;
    protected $repository;
    protected $repositoryGroup;

    public function __construct(
        NotificationService $notiService,
        NotificationRepository $notiRepository,
        NotificationGroupRepository $notiGroupRepository
    )
    {
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

            return $this->sendSuccessResponse($this->service->update($request, $id), __('notification.info.messages._create_success'));
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
        $datas = $this->service->getMembers(['id' => $id]);
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
            $datas = $this->service->getMembers([
                'id' => $request->get('notification_id'),
                'clinic' => $request->get('clinic') ?? '',
                'keyword' => $request->get('keyword') ?? '',
                'status' => $request->get('status') ?? 0,
            ]);
            return new NotificationUserCollection($datas);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'notification_id' => [
                    'required',
                    Rule::exists('notification_users')->where(function ($query) use ($request) {
                        $query->where('notification_id', $request->get('notification_id'));
                        $query->where('user_id', $request->get('user_id'));
                    }),
                ],
                'user_id' => 'required',
                'status' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                throw new \Exception('The given data was invalid', JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }

            $notificationId = $request->get('notification_id');
            $userId = $request->get('user_id');
            $status = $request->get('status');
            $this->service->updateStatus($userId, $notificationId, $status);
            return response()->json([
                'status' => true,
            ]);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage(), [] , $exception->getCode());
        }
    }

    public function fetch(Request $request)
    {
        try {
            $filters['user_id'] = $request->user()->id ?? 0;
            if ($request->get('user_id')) {
                $filters['user_id'] = $request->get('user_id');
            }

            $filters['from'] = $request->get('from') ?? 0;
            $filters['notification_id'] = $request->get('notification_id') ?? null;
            $data = $this->service->fetch($filters);
            return new NotificationFetchCollection($data);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage(), [] , $exception->getCode());
        }
    }
}
