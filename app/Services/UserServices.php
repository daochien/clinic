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
            $role = Role::where('name', 'User')->first();
            $user->assignRole($role);

            $group = Group::find($user->type);
            GroupUser::inserOrIgnore([
                'group_id' => $group->id,
                'user_id' => $user->id
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return $user;
    }
}
