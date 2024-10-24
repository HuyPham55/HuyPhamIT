<?php

namespace App\Http\Resources\Frontend;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'hash' => $this->hash,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'content' => $this->content,
            'publish_date' => formatDate($this->publish_date),
            'author' => new UserResource($this->whenLoaded('author')),
            'tags' => new TagResource($this->whenLoaded('tags')),
        ];
    }
}
