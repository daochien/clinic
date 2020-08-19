<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return AdminResource::collection($this->collection);
    }
}
