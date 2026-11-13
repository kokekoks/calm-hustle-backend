<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
 public function toArray($request): array
{
    return [
        'user_id' => $this->user_id,
        'first_name' => $this->first_name,
        'last_name' => $this->last_name,
        'email' => $this->email,
        'role' => $this->role,
        'created_at' => $this->created_at?->toDateTimeString(),
    ];
}
}
