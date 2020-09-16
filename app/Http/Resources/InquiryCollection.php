<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InquiryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return InquiryResource::collection($this->collection);
    }
}
