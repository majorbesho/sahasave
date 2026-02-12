<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'status' => $this->status,
            'photo' => $this->photo_url,
            'gender' => $this->gender,
            'city' => $this->city,
            'loyalty_points' => $this->available_points ?? 0,
            'loyalty_tier' => $this->loyalty_tier ?? 'bronze',
            'created_at' => $this->created_at,
        ];
    }
}
