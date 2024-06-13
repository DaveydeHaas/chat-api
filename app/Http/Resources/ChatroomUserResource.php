<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatroomUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'is_admin' => $this->is_admin,
            'accepted' => $this->accepted,
            'banned' => $this->banned,
            'joined_at' => $this->joined_at,
            'left_at' => $this->left_at,
            'user' => UserResource::collection($this->whenLoaded('user')),
        ];
    }
}
