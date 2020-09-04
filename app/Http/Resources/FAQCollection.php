<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FAQCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return FAQResource::collection($this->collection);
    }
}
