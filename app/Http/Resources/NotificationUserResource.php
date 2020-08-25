<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class NotificationUserResource extends JsonResource
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
            'user_id' => $this->user_id,
            'notification_id' => $this->notification_id,
            "user" => $this->user,
            "notification" => $this->notification,
            "user_status" => $this->userStatus,            
            "user_confirm_date" => $this->userStatus->updated_at
        ];

        if (App::isLocale('ja')) {
            $datas["user_confirm_date"] = DateHelper::toJaDate($this->userStatus->updated_at);
        }

        return $datas;
    }
}
