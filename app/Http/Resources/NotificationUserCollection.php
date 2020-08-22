<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationUserCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return NotificationUserResource::collection($this->collection);
    }
}
