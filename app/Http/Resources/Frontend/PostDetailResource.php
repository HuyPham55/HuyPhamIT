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
            'id' => data_get($this, 'id'),
            'hash' => data_get($this, 'hash'),
            'title' => data_get($this, 'title'),
            'short_description' => data_get($this, 'short_description'),
            'content' => data_get($this, 'content'),
            'publish_date' => formatDate(data_get($this, 'publish_date')),
            'reading_time' => data_get($this, 'reading_time'),
            'author' => new UserResource($this->whenLoaded('author')),
            'tags' => new TagCollection($this->whenLoaded('tags')),
        ];
    }
}
