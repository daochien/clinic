<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return NotificationResource::collection($this->collection);
    }
}
