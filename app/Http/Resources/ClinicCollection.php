<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ClinicCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return ClinicResource::collection($this->collection);
    }
}
