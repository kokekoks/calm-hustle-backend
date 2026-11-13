<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
 public function toArray($request): array
{
    return [
        'cart_id' => $this->cart_id,
        'user_id' => $this->user_id,
        'user' => new UserResource($this->whenLoaded('user')),
        'product_id' => $this->product_id,
        'product' => new ProductResource($this->whenLoaded('product')),
        'quantity' => (int) $this->quantity,
    ];
}
}
