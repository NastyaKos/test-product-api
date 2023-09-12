<?php

namespace App\Http\Resources\Product;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property-read Product $resource */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'price' => $this->resource->price,
            'slug' => $this->resource->slug,
            'enabled' => $this->resource->enabled,
        ];
    }
}
