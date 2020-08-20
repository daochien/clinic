<?php

namespace App\Repositories;

use App\Models\NotificationGroup;

class NotificationGroupRepository extends BaseRepository
{
    public function getModel()
    {
        return NotificationGroup::class;
    }
}
