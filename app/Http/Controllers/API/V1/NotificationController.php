<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Notifications\NotificationRequest;
use App\Models\Group;
use App\Models\Notification;
use App\Models\NotificationGroup;
use App\Repositories\NotificationGroupRepository;
use App\Repositories\NotificationRepository;
use App\Services\NotificationService;

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
        $data = Notification::latest()->with('notificationGroups.group')->paginate(10);
        return $this->sendResponse($data, 'Notifications list');
    }

    public function store(NotificationRequest $request)
    {
        $entity = $this->service->add($request);
        return $this->sendResponse($entity, 'Notification Created Successfully');
    }

    public function update(NotificationRequest $request, $id)
    {
        $entity = Notification::findOrFail($id);
        $entity->update($request->all());

        return $this->sendResponse($entity, 'Notification information has been updated');
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $entity = Notification::findOrFail($id);

        $entity->delete();

        return $this->sendResponse([$entity], 'Notification has been Deleted');
    }

    public function members($id)
    {
        return $this->service->getMember($id);
    }
}
