<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InquiryCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'attachments' => $this->attachments,
            'user' => new UserItemResource($this->whenLoaded('user'))
        ];
    }
}
