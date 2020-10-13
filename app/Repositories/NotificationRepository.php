<?php

namespace App\Repositories;

use App\Http\Requests\Notifications\SearchNotificationRequest;
use App\Models\Notification;

class NotificationRepository extends BaseRepository
{
    public function getModel()
    {
        return Notification::class;
    }

    public function get()
    {
        return $this->model->latest()
            ->with(['notificationGroups.group'])
            ->withCount(['notificationUsers', 'usersRead', 'usersConfirmed'])
            ->paginate(config('app.item_per_request'));
    }

    public function getAll()
    {
        return $this->model->orderByDesc('id')->get();
    }

    public function search(SearchNotificationRequest $request)
    {
        return $this->model->latest()->with('notificationGroups.group')->paginate(config('app.item_per_request'));
    }

    public function show($id)
    {
        return $this->model->with('notificationGroups.group')->findOrFail($id);
    }
}
