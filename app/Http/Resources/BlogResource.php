<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'title' => $this->title,
            'image' => $this->image,
            'description' => $this->content,
            'short_title' => Str::limit($this->title, 70),
            'short_description' => Str::limit($this->content, 200),
            'created_at' => $this->created_at->format('d/m/Y'),
        ];
    }

    public function getLastLoginTime()
    {
        return $this->loginLog()->orderByDesc('id')->first()->created_at ?? null;
    }
}
