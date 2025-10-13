<?php

namespace App\Http\Resources\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => data_get($this, 'id'),
            'content' => data_get($this, 'content'),
            'author' => new MemberResource($this->whenLoaded('author')),
            'created_at' => data_get($this, 'created_at'),
            'updated_at' => formatDate(data_get($this, 'updated_at')),
            'created_at_human' => Carbon::parse(data_get($this, 'created_at'))->format('F j, Y'),
            'created_at_relative' => Carbon::parse(data_get($this, 'created_at'))->diffForHumans(),
        ];
    }
}
