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
            'size' => $this->size,
            'path' => $this->path,
            'name' => $this->name,
            'extension' => $this->extension,
            'imageable_type' => $this->imageable_type,
            'imageable_id' => $this->imageable_id,
        ];
    }
}
