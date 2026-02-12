<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            'photo' => $this->photo_url,
            'specialization' => $this->specialization,
            'experience' => $this->doctor_experience,
            'rating' => $this->doctor_rating,
            'verification_status' => $this->doctorProfile->verification_status ?? 'unknown',
            'consultation_fee' => $this->doctorProfile->consultation_fee ?? 0,
            'status' => $this->status,
        ];
    }
}
