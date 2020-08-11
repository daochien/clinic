<?php

namespace App\Services;

use App\Models\Clinic;
use App\Models\ClinicUser;
use App\Models\Group;
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

        Group::inserOrIgnore([
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

            DB::beginTransaction();
            ClinicUser::where('clinic_id', $clinicId)->delete();
            $data = [];
            foreach ( $userIds as $userId) {
                $data[] = ['clinic_id' => $clinicId, 'user_id' => $userId];
            }
            ClinicUser::insertOrIgnore($data);
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
            $clinic->delete();
            DB::commit();

            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }

    }
}
