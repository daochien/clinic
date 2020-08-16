<?php


namespace App\Services;


use App\Models\ClinicUser;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\LevelUser;
use App\Models\Role;
use App\Models\Type;
use App\Models\TypeUser;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\If_;

class UserServices
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function updateUser($userId, $attribute) {
        try {
            DB::beginTransaction();
            $user = $this->userRepository->update($userId, $attribute);


            if( !empty($attribute['type_id'] ?? null)) {
                TypeUser::where('user_id', $user->id)->delete();
                TypeUser::insertOrIgnore([
                    'type_id' => $attribute['type_id'],
                    'user_id' => $user->id
                ]);
            }

            GroupUser::where('user_id', $user->id)->delete();
            $type = Type::find($attribute['type_id']);
            $group = Group::where(['name' => $type->name])->first();
            if ($group) {
                $groupUser[] = [
                    'group_id' => $group->id,
                    'user_id' => $user->id
                ];
            }

            foreach ($attribute['groups'] as $group){
                $groupUser[] = [
                    'group_id' => $group['id'],
                    'user_id' => $user->id
                ];
            }
            GroupUser::insertOrIgnore($groupUser);

            ClinicUser::where('user_id', $user->id)->delete();
            $clinicUser = [];
            foreach ($attribute['clinics'] as $clinic){
                $clinicUser[] = [
                    'clinic_id' => $clinic['id'],
                    'user_id' => $user->id
                ];
            }
            ClinicUser::insertOrIgnore($clinicUser);

            if( !empty($attribute['level_id'] ?? null)) {
                TypeUser::where('user_id', $user->id)->delete();
                LevelUser::insertOrIgnore([
                    'level_id' => $attribute['level_id'],
                    'user_id' => $user->id
                ]);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function createUser($attribute)
    {
        try {
            DB::beginTransaction();
            $user = $this->userRepository->createUser($attribute);

            // Assigning Role by default user role
            $user->assignRole(Role::ROLE_USER_DEFAULT);

            if( !empty($attribute['type_id'] ?? null)) {
                TypeUser::insertOrIgnore([
                    'type_id' => $attribute['type_id'],
                    'user_id' => $user->id
                ]);
            }

            $type = Type::find($attribute['type_id']);
            $group = Group::where(['name' => $type->name])->first();
            if ($group) {
                $groupUser[] = [
                    'group_id' => $group->id,
                    'user_id' => $user->id
                ];
            }

            foreach ($attribute['groups'] as $group){
                $groupUser[] = [
                    'group_id' => $group['id'],
                    'user_id' => $user->id
                ];
            }
            GroupUser::insertOrIgnore($groupUser);

            $clinicUser = [];
            foreach ($attribute['clinics'] as $clinic){
                $clinicUser[] = [
                    'clinic_id' => $clinic['id'],
                    'user_id' => $user->id
                ];
            }
            ClinicUser::insertOrIgnore($clinicUser);


            if( !empty($attribute['level_id'] ?? null)) {
                LevelUser::insertOrIgnore([
                    'level_id' => $attribute['level_id'],
                    'user_id' => $user->id
                ]);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return $user;
    }
}
