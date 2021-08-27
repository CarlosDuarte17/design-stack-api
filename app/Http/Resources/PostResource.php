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
            'created_at' => $this->created_at,
            'description' => $this->description,
            'id' => $this->id,
            'likes' => $this->likes->count(),
            'media' => new MediaCollection($this->medias),
            'tags' => new TagCollection($this->tags),
            'title' => $this->title,
            'updated_at' => $this->updated_at,
            'user' => new UserResource($this->user),
            'viewer_liked' => $this->likes()->where('user_id', $request->user()->id)->exists(),
        ];
    }
}
