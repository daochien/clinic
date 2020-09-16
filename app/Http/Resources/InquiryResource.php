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
            "created_at" => $this->created_at,
            "created_by" => new UserItemResource($this->whenLoaded('createdBy')),
            'inquiry_comments' => InquiryCommentResource::collection($this->whenLoaded('inquiryComments')),
            'closed_by' => UserItemResource::collection($this->whenLoaded('closedBy')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'closed_at' => $this->closed_at
        ];
    }
}
