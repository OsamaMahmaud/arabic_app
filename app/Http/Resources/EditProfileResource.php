<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EditProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->fullname,
            'email' => $this->email,
            'image' => $this->getProfileImageUrl(),
           
        ];
    }

    public function getProfileImageUrl()
    {
        $mediaItem = $this->getFirstMedia('profile_images');
        return $mediaItem ? $mediaItem->getUrl() : null;
    }

   
}
