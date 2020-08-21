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
            'users_count' => $this->usersCount(),
            'users_read' => $this->usersRead(),
            'users_confirm' => $this->usersConfirm(),
            'users' => UserResource::collection($this->whenLoaded('users')),
        ];

        if (App::isLocale('ja')) {
            $datas["created_at"] = DateHelper::toJaDate($this->created_at);
            $datas["schedule_date"] = DateHelper::toJaDate($this->schedule_date);
        }

        return $datas;
    }
}
