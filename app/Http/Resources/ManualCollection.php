<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ManualCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'status' => true,
            'data' => ManualResource::collection($this->collection)
        ];
    }
}
