<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
{
    return [
        'product_id' => $this->product_id,
        'category_id' => $this->category_id,
        'category' => new CategoryResource($this->whenLoaded('category')),
        'name' => $this->name,
        'description' => $this->description,
        'price' => (float) $this->price,
        'stock' => (int) $this->stock,
        'image' => $this->image,
    ];
}
}
