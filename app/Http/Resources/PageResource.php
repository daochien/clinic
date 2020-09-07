<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
            'type' => $this->type,
            'image' => $this->image,
            'content' => $this->content,
            'status' => $this->status,
            'files' => $this->_getFile($this->files),
            'category_id' => $this->category_id,
            'category_name' => $this->categorys->name,
            'created_at' => $this->created_at            
        ];
    }

    protected function _getFile($files)
    {
        if (!empty($files)) {
            $files = json_decode($files, true);            
            return @$files['path'];
        }

        return '';
    }
}
