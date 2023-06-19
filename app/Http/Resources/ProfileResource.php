<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'name' => $this->name,
            'username' => $this->username,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'image' => $this->image,
            'temporary_address' =>$this->profile->temporary_address,
            'permanent_address' =>$this->profile->permanent_address,
            'latitude' =>$this->profile->latitude,
            'longitude' =>$this->profile->longitude,
            'gender' =>$this->profile->gender,
        ];
    }
}
