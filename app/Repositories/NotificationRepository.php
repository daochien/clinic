<?php

namespace App\Repositories;

use App\Models\Notification;
use Frameworks\Cores\Repositories\BaseRepository;

class NotificationRepository extends BaseRepository
{
    public function __construct(Notification $model)
    {
        $this->model = $model;
    }
}
