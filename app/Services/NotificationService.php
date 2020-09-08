<?php

namespace App\Services;

use App\Http\Requests\Notifications\NotificationRequest;
use App\Http\Requests\Notifications\SearchNotificationRequest;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Notification;
use App\Models\NotificationGroup;
use App\Models\NotificationStatus;
use App\Repositories\NotificationRepository;
use App\Repositories\NotificationGroupRepository;
use App\Models\NotificationUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationService
{
    protected $repository;
    protected $repositoryGroup;

    public function __construct(
        NotificationRepository $notificationRepository,
        NotificationGroupRepository $notiGroupRepository
    )
    {
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
            'created_by' => Auth::id(),
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
            $datas = GroupUser::where('group_id', $group['id'])->get();
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
        return NotificationUser::where('notification_id', $id)
            ->with([
                'userStatus',
                'notification',
                'user',
                'user.clinic',
                'user.group'
            ])->paginate(10);
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
        try {
            DB::beginTransaction();
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
            $groups = $request['groups'];
            if (!$groups) {
                return $entity;
            }

            NotificationGroup::where('notification_id', '=', $id)->delete();
            NotificationUser::where('notification_id', '=', $id)->delete();
            foreach ($groups as $group) {
                // Create notification group
                NotificationGroup::insertOrIgnore([
                    'notification_id' => $entity->id,
                    'group_id' => $group['id']
                ]);

                // Create notification user in group
                $datas = GroupUser::where('group_id', $group['id'])->get();
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

            DB::commit();
            return $entity;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function search($request)
    {
        $datas = Notification::where(
            function ($qstatus) use ($request) {
                if (isset($request['status'])) {
                    $qstatus->where('draft', '=', $request['status']);
                }
            }
        )
            ->where(
                function ($qtitle) use ($request) {
                    if (isset($request['keyword']) && strlen($request['keyword']) > 0) {
                        $qtitle->where('title', 'like', '%' . $request['keyword'] . '%');
                    }
                }
            )
            ->where(
                function ($qdate) use ($request) {
                    if (!empty($request['release_date'])) {
                        $qdate->whereBetween('schedule_date', [new \Carbon\Carbon($request['release_date']['startDate']), new \Carbon\Carbon($request['release_date']['endDate'])]);
                    }
                }
            )
            ->whereHas(
                'notificationGroups.group',
                function ($qgroup) use ($request) {
                    if (isset($request['group']) && strlen($request['group']) > 0) {
                        $qgroup->where('name', '=', $request['group']);
                    }
                }
            )
            ->with([
                'notificationGroups.group'
            ]);

        return $datas->paginate(10);
    }

    public function detailSearch(SearchNotificationRequest $request)
    {
        if (!isset($request['notification_id'])) {
            return null;
        }
        $id = $request['notification_id'];
        $datas = NotificationUser::where('notification_id', $id)
            ->whereHas(
                'userStatus',
                function ($qstatus) use ($request) {
                    if ($request['status'] == '0') {
                        $qstatus->whereIn('status', [1, 2, 3]);
                    } else {
                        $qstatus->where('status', '=', $request['status']);
                    }
                }
            )
            ->whereHas(
                'user',
                function ($quser) use ($request) {
                    if (isset($request['keyword']) && strlen($request['keyword']) > 0) {
                        if (strpos($request['keyword'], '@') === false) {
                            $quser->where('name', 'like', '%' . $request['keyword'] . '%');
                        } else {
                            $quser->where('email', 'like', '%' . explode("@", $request['keyword'])[0] . '%');
                        }
                    }
                }
            )
            ->whereHas(
                'user.clinic',
                function ($qclinic) use ($request) {
                    if (isset($request['clinic']) && strlen($request['clinic']) > 0) {
                        $qclinic->where('name', '=', $request['clinic']);
                    }
                }
            )
            ->with([
                'userStatus',
                'notification',
                'user.clinic',
                'user.group'
            ]);

        return $datas->paginate(10);
    }

    public function fetch($filters)
    {
        $notificationUsers = NotificationUser::with(['notification', 'notification.creator', 'notification.status'])->orderBy('notifications.created_at', 'desc');
        if (!empty($filters['user_id'])) {
            $notificationUsers->where('user_id', $filters['user_id']);
        }

        if (!empty($filters['from'])) {
            $notificationUsers->join('notifications', 'notification_users.notification_id', 'notifications.id')
            ->join('users', 'users.id', 'notifications.created_by')->where('users.posittion', $filters['from']);
        } else {
            $notificationUsers->join('notifications', 'notification_users.notification_id', 'notifications.id')
                ->join('users', 'users.id', 'notifications.created_by')->where('users.posittion', '!=', $filters['from']);
        }

        return $notificationUsers->whereHas('notification')->select('notification_users.*')->paginate(20);
    }
}
