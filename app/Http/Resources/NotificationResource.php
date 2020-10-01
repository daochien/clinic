<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

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
        $datas = [
            'id' => $this->id,
            'title' => $this->title,
            "content" => $this->content,
            "confirm" => $this->confirm,
            "draft" => $this->draft,
            "schedule_date" => $this->schedule_date,
            "created_at" => $this->created_at,
            'groups' => $this->notificationGroups,
            'notification_users_count' => $this->notification_users_count,
            'users_read' => $this->users_read_count,
            'users_confirmed_count' => $this->users_confirmed_count,
            'users' => UserResource::collection($this->whenLoaded('users')),
        ];

        return $datas;
    }
}
