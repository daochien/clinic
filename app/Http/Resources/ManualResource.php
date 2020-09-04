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
            'short_title' => Str::limit($this->title, 40),
            // 'email' => $this->email,
            // 'description' => $this->description,
            'created_at' => $this->created_at->format('d/m/Y'),
        ];
    }

    public function getFile($files)
    {
        if (!empty($files)) {
            $files = json_decode($files);
            return $files[0];
        }
        return '';
    }
}
