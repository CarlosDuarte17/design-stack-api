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
            'FullPath' => $this->FullPath,
            'path' => $this->media_path,
            'post_id' => $this->post_id,
            'source' => $this->media_source,
            'type' => $this->type
        ];
    }
}
