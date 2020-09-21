<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
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
            'template_id' => $this->form_id,
            "content" => $this->content,
            "request_logs" => $this->requestLogs,
            "request_comments" => $this->requestComments,
            "template" => $this->form,
            "created_at" => $this->created_at,
            "user" => new UserItemResource($this->whenLoaded('user')),
            "user" => new UserItemResource($this->whenLoaded('user')),
        ];
    }
}
