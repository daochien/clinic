<?php


namespace App\Services;


use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Role;
use App\Models\Type;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

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

            if( !empty($attribute['group_ids'] ?? null)) {
                $groupUser = [];
                foreach ($attribute['group_ids'] as $groupId){
                    $groupUser[] = [
                        'group_id' => $groupId,
                        'user_id' => $user->id
                    ];
                }
                GroupUser::inserOrIgnore($groupUser);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return $user;
    }
}
