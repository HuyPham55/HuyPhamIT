<?php

namespace App\Http\Resources\Frontend;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Member $this */
        return array_merge(parent::toArray($request), [
            'profile_picture' => either($this->profile_picture, "/images/no-image.png")
        ]);
    }
}
