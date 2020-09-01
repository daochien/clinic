<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ManualCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return ManualResource::collection($this->collection);
    }
}
