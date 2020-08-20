<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            "content" => $this->content,
            "confirm" => $this->confirm,
            "draft" => $this->draft,
            "schedule_date" => $this->schedule_date,
            "created_at" => $this->created_at,
            'groups' => $this->notificationGroups,
            'users_count' => $this->usersCount(),
            'users_read' => $this->usersRead(),
            'users_confirm' => $this->usersConfirm(),
            'users' => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}
