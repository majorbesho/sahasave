<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'scheduled_for' => $this->scheduled_for,
            'status' => $this->status,
            'patient_notes' => $this->patient_notes,
            'doctor_notes' => $this->doctor_notes,
            'patient' => new UserResource($this->whenLoaded('patient')),
            'doctor' => new UserResource($this->whenLoaded('doctor')),
            'medical_center' => $this->whenLoaded('medicalCenter'),
            'created_at' => $this->created_at,
        ];
    }
}
