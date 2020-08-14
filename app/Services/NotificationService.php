<?php

namespace App\Services;

use App\Http\Requests\Notifications\NotificationRequest;
use App\Models\Group;
use App\Repositories\NotificationRepository;
use App\Repositories\NotificationGroupRepository;
use App\Models\GroupUser;
use App\Models\NotificationGroup;
use App\Models\NotificationUser;

class NotificationService
{
    protected $repository;
    protected $repositoryGroup;

    public function __construct(
        NotificationRepository $notificationRepository,
        NotificationGroupRepository $notiGroupRepository
    ) {
        $this->repository = $notificationRepository;
        $this->repositoryGroup = $notiGroupRepository;
    }

    public function add(NotificationRequest $request)
    {
        $entity = $this->repository->create([
            'title' => $request['title'],
            'content' => $request['content'],
            'confirm' => $request['confirm'],
            'draft' => $request['draft'],
        ]);

        $groups = $request['groups'];
        foreach ($groups as $group) {

            // Create notification group
            $entityGroup = $this->repositoryGroup->create([
                'notification_id' => $entity->id,
                'group_id' => $group['id']
            ]);

            // Create notification user in group
            $groupUser = Group::find($group['id'])->first();
            $datas = $groupUser->users()->get();
            foreach ($datas as $user) {
                NotificationUser::insertOrIgnore([
                    'notification_id' => $entity->id,
                    'user_id' => $user->id
                ]);
            }
        }
        return $entity;
    }

    public function getMember($id = 0)
    {
        $entities  = NotificationUser::where('notification_id', $id)->with('user')->get();
        if ($entities->count() > 0) {
            return response()->json(['data' => ['data' => $entities]]);
        }
        return response()->json(['data' => ['data' => []]]);
    }
}
