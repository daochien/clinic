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
            'name' => $this->name,
            "post_code" => "$this->post_code",
            "address" => "$this->address",
            "description" => $this->description,
            'users_count' => $this->usersCount(),
            'users' => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}
