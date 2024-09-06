<?php

namespace App\Http\Resources\Event;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "error" => null,
            "result" => [
                'id' => $this->id,
                'title' => $this->title,
                'text' => $this->text,
                'user_created' => new UserResource($this->creator),
                'user_joined' => UserResource::collection($this->users),
            ],
        ];
    }
}
