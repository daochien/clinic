<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationFetchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response = [
            'user_id' => $this->user_id,
            'notification_id' => $this->notification_id,
            'title' => $this->notification->title,
            'content' => $this->notification->content,
            'status' => $this->status->pluck('id'),
            'created_at' => $this->created_at,
            'creator' => [
                'name' => $this->notification->creator->name,
                'position' => $this->notification->creator->posittion,
            ]
        ];

        return $response;
    }
}
