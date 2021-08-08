<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'imagable_type' => $this->imagable_type,
            'imagable_id' => $this->imagable_id,
            'size' => $this->size,
            'path' => $this->path,
            'name' => $this->name,
            'extension' => $this->extension,
            'issue_id' => $this->issue_id,
            'comment_id' => $this->comment_id
        ];
    }
}
