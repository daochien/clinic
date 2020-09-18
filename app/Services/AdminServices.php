<?php
namespace App\Services;

use App\Helpers\PasswordHelper;
use App\Models\TypeUser;
use App\Models\User;
use App\Events\CreateAdminEvent;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class AdminServices
{
    protected $userRepository;
    protected $user;

    public function __construct(UserRepository $userRepository, User $user)
    {
        $this->userRepository = $userRepository;
        $this->user = $user;
    }

    public function createAdmin($attribute)
    {
       DB::beginTransaction();
        try {

            $attribute['password'] = PasswordHelper::randomPassword();
            $admin = $this->userRepository->createAdmin($attribute);

            try {
                event(new CreateAdminEvent($admin, $attribute['password']));
            } catch (\Exception $e) {}
            
            $admin->assignRole($attribute['roles']);
            
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $admin;
    }

    public function updateAdmin($id, $attribute)
    {
        DB::beginTransaction();
        try {
            $admin = $this->user->findOrFail($id);

            $admin->update($attribute);            

            $admin->syncRoles($attribute['roles']);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        
        return $admin;
        
    }
}
?>
