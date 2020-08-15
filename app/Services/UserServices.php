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

            if( !empty($attribute['group_ids'] ?? null)) {
                if (is_array($attribute['group_ids'])) {
                    foreach ($attribute['group_ids'] as $groupId){
                        $groupUser[] = [
                            'group_id' => $groupId,
                            'user_id' => $user->id
                        ];
                    }
                } else {
                    $groupUser[] = [
                        'group_id' => $attribute['group_ids'],
                        'user_id' => $user->id
                    ];
                }
            }
            GroupUser::insertOrIgnore($groupUser);

            if( !empty($attribute['clinic_ids'] ?? null)) {
                if (is_array($attribute['clinic_ids'])) {
                    $clinicUser = [];
                    foreach ($attribute['clinic_ids'] as $clinicId){
                        $clinicUser[] = [
                            'clinic_id' => $clinicId,
                            'user_id' => $user->id
                        ];
                    }
                } else {
                    $clinicUser[] = [
                        'clinic_id' => $attribute['clinic_ids'],
                        'user_id' => $user->id
                    ];
                }
                ClinicUser::insertOrIgnore($clinicUser);
            }


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
