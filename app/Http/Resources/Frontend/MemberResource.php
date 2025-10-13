<?php

namespace App\Http\Resources\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravolt\Avatar\Facade as AvatarFacade;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\Member $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'gender' => $this->gender,
            'profile_picture' => either($this->profile_picture, AvatarFacade::create($this->name)->toBase64()),
            'created_at' => $this->created_at,
        ];
    }
}
