<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Level;
use App\Models\Role;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    protected $level = '';

    public function getLevel()
    {
        return $this->sendSuccessResponse(Level::all(['id', 'name']));
    }

    public function getType()
    {
        return $this->sendSuccessResponse(Type::all(['id', 'name']));
    }

    public function getUserRoles()
    {
        return $this->sendSuccessResponse(Role::whereIn('id',[3,4])->get(['id', 'name']));
    }
}
