<?php


namespace App\Services;


use App\Events\CreateUserEvent;
use App\Helpers\PasswordHelper;
use App\Models\Clinic;
use App\Models\ClinicUser;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\LevelUser;
use App\Models\Role;
use App\Models\RoleUser;
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

            // Assigning Role by default user role
            $user->syncRoles($attribute['role']['name']);

            $this->deleteOldGroupHaveSaveType($user, $attribute);
            $this->deleteOldGroupHaveSaveCLinicName($user);

            $clinicUser = [];
            $clinicNameList = [];
            foreach ($attribute['clinics'] as $clinic){
                $clinicNameList[] = $clinic['name'];
                $clinicUser[] = [
                    'clinic_id' => $clinic['id'],
                    'user_id' => $user->id
                ];
            }
            ClinicUser::insertOrIgnore($clinicUser);
            $this->addUserToGroupSameClinicName($clinicNameList, $user);

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
            $attribute['password'] = PasswordHelper::randomPassword();
            $user = $this->userRepository->createUser($attribute);
            event(new CreateUserEvent($user, $attribute['password']));
            $user->assignRole($attribute['role']['name']);

            if( !empty($attribute['type_id'] ?? null)) {
                TypeUser::insertOrIgnore([
                    'type_id' => $attribute['type_id'],
                    'user_id' => $user->id
                ]);
            }

            $clinicUser = [];
            $clinicNameList = [];
            foreach ($attribute['clinics'] as $clinic){
                $clinicNameList[] = $clinic['name'];
                $clinicUser[] = [
                    'clinic_id' => $clinic['id'],
                    'user_id' => $user->id
                ];
            }
            ClinicUser::insertOrIgnore($clinicUser);

            $groupUser = $this->addUserToGroupSameClinicName($clinicNameList, $user);
            $groupUser[] = $this->addUserToGroupHaveSameType($attribute, $user);
            GroupUser::insertOrIgnore($groupUser);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return $user;
    }

    /**
     * @param $clinicNameList
     * @param $user
     */
    public function addUserToGroupSameClinicName($clinicNameList, $user)
    {
        $groupUser = [];
        $clinicNames = Clinic::whereIn('name', $clinicNameList)->select('name')->get();
        $groups = Group::whereIn('name', $clinicNames)->get();
        foreach ($groups as $group) {
            $groupUser[] = [
                'group_id' => $group->id,
                'user_id' => $user->id
            ];
        }
        GroupUser::insertOrIgnore($groupUser);
    }

    /**
     * @param $attribute
     * @param $user
     * @return array
     */
    public function addUserToGroupHaveSameType($attribute, $user)
    {
        $groupUser = [];
        $groupTypeName = Type::find($attribute['type_id'])->name;

        $group = Group::where(['name' => $groupTypeName])->first();
        if ($group) {
            return [
                'group_id' => $group->id,
                'user_id' => $user->id
            ];
        }

        return [];
    }

    /**
     * @param bool $user
     * @throws \Exception
     */
    public function deleteOldGroupHaveSaveCLinicName(bool $user): void
    {
        $currentClinicNames = $user->clinic()->select('name')->get();
        if (!empty($currentClinicNames)) {
            GroupUser::from('group_users as gu')
                ->join('groups as g', 'g.id', 'gu.group_id')
                ->whereIn('g.name', $currentClinicNames->pluck('name'))
                ->where('gu.user_id', $user->id)
                ->delete();
            ClinicUser::where('user_id', $user->id)->delete();
        }
    }

    /**
     * @param bool $user
     * @param $attribute
     * @throws \Exception
     */
    public function deleteOldGroupHaveSaveType(bool $user, $attribute): void
    {
        $currentTypeUser = TypeUser::where('user_id', $user->id)->first();

        if ($currentTypeUser->type_id != $attribute) {
            $currentType = Type::find($currentTypeUser->type_id);
            $currentTypeGroup = Group::where(['name' => $currentType->name])->first();

            if (!empty($currentTypeGroup)) {
                GroupUser::where(['user_id' => $user->id, 'group_id' => $currentTypeGroup->id])->delete();
                TypeUser::where(['user_id' => $user->id, 'type_id' => $currentType->id])->delete();
            }

            TypeUser::insertOrIgnore([
                'type_id' => $attribute,
                'user_id' => $user->id
            ]);
            $newType = Type::find($attribute);
            $newGroup = Group::where(['name' => $newType->name])->first();
            GroupUser::insertOrIgnore([
                'group_id' => $newGroup->id,
                'user_id' => $user->id
            ]);
        }
    }
}
