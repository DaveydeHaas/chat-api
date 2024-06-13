<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'pivot' => $this->whenPivotLoaded('chatroom_users', function () {
                return [
                    'is_admin' => $this->pivot->is_admin,
                    'accepted' => $this->pivot->accepted,
                    'banned' => $this->pivot->banned,
                    'joined_at' => $this->pivot->joined_at,
                    'left_at' => $this->pivot->left_at,
                ];
            }),
        ];
    }
}
