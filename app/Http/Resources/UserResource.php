<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'created_at' => $this->created_at,
            'groups' => GroupResource::collection($this->group),
            'last_login' => $this->getLastLoginTime(),
            'role' => ['id' => $this->roles[0]->id ?? 0, 'name' => $this->roles[0]->name ?? ''],
            'clinics' => ClinicResource::collection($this->whenLoaded('clinic')),
            'type' => TypeResource::collection($this->whenLoaded('type')),
            'level' => LevelResource::collection($this->whenLoaded('level')),
        ];
    }

    public function getLastLoginTime()
    {
        return $this->loginLog()->orderByDesc('id')->first()->created_at ?? null;
    }
}
