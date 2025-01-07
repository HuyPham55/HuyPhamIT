<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        /** @var \App\Models\Post $this */
        return [
            'id' => $this->id,
            'hash' => $this->hash,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'publish_date' => formatDate($this->publish_date),
            'author' => new UserResource($this->whenLoaded('author')),
            'tags' => new TagCollection($this->whenLoaded('tags')),
        ];
    }
}
