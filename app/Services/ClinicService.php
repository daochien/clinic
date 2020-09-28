<?php

namespace App\Services;

use App\Models\Clinic;
use App\Models\ClinicUser;
use App\Models\Group;
use App\Models\GroupUser;
use App\Repositories\ClinicRepository;
use Illuminate\Support\Facades\DB;

class ClinicService
{
    protected $clinicRepository;

    public function __construct(ClinicRepository $clinicRepository)
    {
        $this->clinicRepository = $clinicRepository;
    }

    public function createClinic($data)
    {
        $clinic = $this->clinicRepository->create($data);

        Group::insertOrIgnore([
           'name' => $clinic->name
        ]);

        return $clinic;
    }

    public function addRelationUser($clinicId, array $userIds)
    {
        try {
            if (!isset($userIds, $clinicId)) {
                return;
            }
            $clinic = $this->clinicRepository->find($clinicId);
            $group = Group::where('name', $clinic->name)->first();

            DB::beginTransaction();
            // delete all old relation
            ClinicUser::where('clinic_id', $clinic->id)->delete();
            GroupUser::where('group_id', $group->id)->delete();
            //create new relation
            $clinicUserData = [];
            $groupUserData = [];
            foreach ( $userIds as $userId) {
                $clinicUserData[] = ['clinic_id' => $clinicId, 'user_id' => $userId];
                $groupUserData[] = ['group_id' => $group->id, 'user_id' => $userId];
            }
            ClinicUser::insertOrIgnore($clinicUserData);
            GroupUser::insertOrIgnore($groupUserData);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function delete($id)
    {
        /* @var Clinic $clinic*/
        $clinic = $this->clinicRepository->find($id);
        try {
            DB::beginTransaction();
            $clinic->clinicUsers()->delete();
            $clinic->delete();
            DB::commit();

            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }

    }
}
