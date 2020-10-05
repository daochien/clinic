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
            try {
                event(new CreateUserEvent($user, $attribute['password']));
            } catch (\Exception $e) {

            }
            
            $user->assignRole($attribute['role']['name']);

            if( !empty($attribute['type_id'] ?? null)) {
                TypeUser::insertOrIgnore([
                    'type_id' => $attribute['type_id'],
                    'user_id' => $user->id
                ]);

                $this->addUserToGroupHaveSameType($attribute, $user);
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
            $this->addUserToGroupSameClinicName($clinicNameList, $user);

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
        $groupTypeName = Type::find($attribute['type_id'])->name;
        $group = Group::where(['name' => $groupTypeName])->first();

        if ($group) {
            GroupUser::insertOrIgnore([
                'group_id' => $group->id,
                'user_id' => $user->id
            ]);
        }

    }

    /**
     * @param $user
     * @throws \Exception
     */
    public function deleteOldGroupHaveSaveCLinicName($user): void
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
     * @param $user
     * @param $attribute
     * @throws \Exception
     */
    public function deleteOldGroupHaveSaveType($user, $attribute): void
    {
        $currentType = $user->type()->first();

        if (!empty($currentType)) {
            $currentGroup = Group::where(['name' => $currentType->name])->first();

            if (!empty($currentGroup)) {
                GroupUser::where(['user_id' => $user->id, 'group_id' => $currentGroup->id])->delete();
            }
            TypeUser::where(['user_id' => $user->id])->delete();
        }

        if ($attribute['type_id'] ?? null){
            TypeUser::insertOrIgnore([
                'type_id' => $attribute['type_id'],
                'user_id' => $user->id
            ]);
            $newType = Type::find($attribute['type_id']);
            $newGroup = Group::where(['name' => $newType->name])->first();
            GroupUser::insertOrIgnore([
                'group_id' => $newGroup->id,
                'user_id' => $user->id
            ]);
        }

    }
}
