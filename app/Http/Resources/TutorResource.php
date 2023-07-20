<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TutorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => (string) $this->id,
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'picture' => $this->picture,
            'phone_number' => $this->phone_number,
            'budget' => $this->budget,
            'email' => $this->email,
            'bio' => $this->bio,
            'rate' => $this->rate,
            'id_photo' => $this->id_photo,
            'certification' => $this->certification,
            'c_v' => $this->c_v,
        ];
    }
}
