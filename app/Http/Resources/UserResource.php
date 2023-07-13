<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

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
        ];
    }
}
