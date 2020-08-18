<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Level;
use App\Models\Role;
use App\Models\Type;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    protected $level = '';

    public function getLevel()
    {
        return $this->sendResponse(Level::all(['id', 'name']));
    }

    public function getType()
    {
        return $this->sendResponse(Type::all(['id', 'name']));
    }

    public function getUserRole()
    {
        return $this->sendResponse(Role::USER_ROLE);
    }
}
