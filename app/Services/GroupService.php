<?php

namespace App\Services;

use App\Models\Group;
use App\Models\GroupUser;
use App\Repositories\GroupRepository;
use Illuminate\Support\Facades\DB;

class GroupService
{
    protected $groupRepository;

    public function __construct(groupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function createGroup($data)
    {
        $group = $this->groupRepository->create($data);
        return $group;
    }

    public function addRelationUser($groupId, array $userIds)
    {
        try {
            if (!isset($userIds, $clinicId)) {
                return;
            }
            $group = $this->groupRepository->find($groupId);
            $group = Group::where('name', $group->name)->first();

            DB::beginTransaction();
            $groupUserData = [];
            foreach ( $userIds as $userId) {
                $groupUserData[] = ['group_id' => $group->id, 'user_id' => $userId];
            }
            GroupUser::insertOrIgnore($groupUserData);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function delete($id)
    {
        $group = $this->groupRepository->find($id);
        try {
            DB::beginTransaction();
            $group->groupUsers()->delete();
            $group->delete();
            DB::commit();

            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }

    }
}
