<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'post_id' => $this->id,
            'user' => $this->user,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'imageFullPath' => $this->imageFullPath,
        ];
    }
}
