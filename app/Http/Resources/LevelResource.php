<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LevelResource extends JsonResource
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
            // 'lessons_count'=>$this->lessons_count,
            'lessons_count'=>$this->videos_count,
            
            // 'products' => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}