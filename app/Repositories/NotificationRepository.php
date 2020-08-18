<?php

namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository extends BaseRepository
{
    public function getModel()
    {
        return Notification::class;
    }

    public function get()
    {
        return $this->model->latest()->with('notificationGroups.group')->paginate(10);
    }

    public function getAll()
    {
        return $this->model->orderByDesc('id')->get();
    }
}
