<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return GroupResource::collection($this->collection);
    }
}
