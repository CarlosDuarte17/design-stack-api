<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
            'post_id' => $this->post_id,
            'path' => $this->media_path,
            'source' => $this->media_source,
            'FullPath' => $this->FullPath,
            'type' => $this->type
        ];
    }
}
