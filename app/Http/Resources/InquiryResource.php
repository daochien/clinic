<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InquiryResource extends JsonResource
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
            'category_id' => $this->category_id,
            "title" => $this->title,
            "question" => $this->question,
            "status" => $this->status,
            "created_by" => $this->created_by,
            'inquiry_comments' => InquiryCommentResource::collection($this->whenLoaded('inquiryComments')),
            'closed_by' => UserItemResource::collection($this->whenLoaded('closedBy')),
        ];
    }
}
