<?php
namespace App\Services;

use App\Helpers\PasswordHelper;
use App\Models\TypeUser;
use App\Events\CreateAdminEvent;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class AdminServices
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createAdmin($attribute)
    {
       DB::beginTransaction();
        try {

            $attribute['password'] = PasswordHelper::randomPassword();
            $admin = $this->userRepository->createAdmin($attribute);
            event(new CreateAdminEvent($admin, $attribute['password']));
            $admin->assignRole($attribute['roles']);

            if( !empty($attribute['type_id'] ?? null)) {
                TypeUser::insertOrIgnore([
                    'type_id' => $attribute['type_id'],
                    'user_id' => $admin->id
                ]);
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
        }

        return $admin;
    }
}
?>
