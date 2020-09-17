<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RequestCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return RequestResource::collection($this->collection);
    }
}
