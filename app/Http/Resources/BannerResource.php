<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [


            'id' => $this->id,
            'title' => $this->title,
            'photo' => $this->photo,
            'youtube' => $this->youtube,
            'status' => $this->status,
            'discreption' => $this->discreption,
            'slug' => $this->slug,
            'bigTitle' => $this->bigTitle,
            'smallTitle' => $this->smallTitle,
            'type' => $this->type,
            'name' => $this->name,
            'youtube' => $this->youtube,

        ];
    }
}
