<?php

namespace App\Http\Resources\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    /*
     * Note: This is not necessary
     * Because Laravel will detect automatically, but it's verbose
     */
    public $collects = PostResource::class;


    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {

        //return parent::toArray($request);
        return [
            'data' => $this->collection,
        ];
    }
}
