<?php

namespace App\Services;

use App\Http\Requests\Notifications\NotificationRequest;
use App\Http\Requests\Notifications\SearchNotificationRequest;
use App\Models\Group;
use App\Models\NotificationGroup;
use App\Models\NotificationStatus;
use App\Repositories\NotificationRepository;
use App\Repositories\NotificationGroupRepository;
use App\Models\NotificationUser;
use Illuminate\Support\Facades\DB;

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
        $data = [
            'title' => $request['title'],
            'content' => $request['content'],
            'confirm' => $request['confirm'],
            'draft' => $request['draft'],
        ];

        if (isset($request['schedule_date'])) {
            $data['schedule_date'] = $request['schedule_date'];
        }

        $entity = $this->repository->create($data);

        $groups = $request['groups'];
        foreach ($groups as $group) {

            // Create notification group
            NotificationGroup::insertOrIgnore([
                'notification_id' => $entity->id,
                'group_id' => $group['id']
            ]);

            // Create notification user in group
            $groupUser = Group::find($group['id'])->first();
            $datas = $groupUser->users()->get();
            foreach ($datas as $user) {
                NotificationUser::insertOrIgnore([
                    'notification_id' => $entity->id,
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                if ($request['confirm'] == true) {
                    NotificationStatus::insertOrIgnore([
                        'notification_id' => $entity->id,
                        'user_id' => $user->id,
                        'status' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
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

    public function delete($id)
    {
        $entity = $this->repository->find($id);
        try {
            DB::beginTransaction();
            $entity->delete();
            DB::commit();

            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
    }


    public function update(NotificationRequest $request, $id)
    {
        $data = [
            'title' => $request['title'],
            'content' => $request['content'],
            'confirm' => $request['confirm'],
            'draft' => $request['draft'],
        ];

        if (isset($request['schedule_date'])) {
            $data['schedule_date'] = $request['schedule_date'];
        }

        $entity = $this->repository->update($id, $data);

        NotificationGroup::where('notification_id', '=', $id)->delete();
        NotificationUser::where('notification_id', '=', $id)->delete();

        $groups = $request['groups'];
        foreach ($groups as $group) {

            // Create notification group
            NotificationGroup::insertOrIgnore([
                'notification_id' => $entity->id,
                'group_id' => $group['id']
            ]);

            // Create notification user in group
            $groupUser = Group::find($group['id'])->first();
            $datas = $groupUser->users()->get();
            foreach ($datas as $user) {
                NotificationUser::insertOrIgnore([
                    'notification_id' => $entity->id,
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                if ($request['confirm'] == true) {
                    NotificationStatus::insertOrIgnore([
                        'notification_id' => $entity->id,
                        'user_id' => $user->id,
                        'status' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                } else {
                    NotificationStatus::where('notification_id', '=', $id)->delete();
                }
            }
        }
        return $entity;
    }

    public function search(SearchNotificationRequest $request)
    {
        return $this->repository->search($request);
    }
}
