<?php

namespace App\Repositories;

use App\Models\NotificationGroup;
use Frameworks\Cores\Repositories\BaseRepository;

class NotificationGroupRepository extends BaseRepository
{
    public function __construct(NotificationGroup $model)
    {
        $this->model = $model;
    }
}
