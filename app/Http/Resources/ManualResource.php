<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class ManualResource extends JsonResource
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
            'files' => $this->getFile($this->files),
            'type' => $this->type,
            'image' => $this->image,
            'category_id' => $this->category_id,
            'catetory_name' => @$this->categorys->name,                        
            'content' => $this->content,
            'created_at' => $this->created_at,
        ];
    }

    public function getFile($files)
    {
        if (!empty($files)) {
            $files = json_decode($files);
            return $files;
        }
        return '';
    }
}
