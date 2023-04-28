<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromoCodeResource extends JsonResource
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
            "id"=> $this->id,
            "title"=> $this->title,
            "code"=> $this->code,
            "promo_type"=> $this->promo_type,
            "worth"=> $this->worth,
            "activation_date"=> $this->activation_date,
            "expire_date"=> $this->expire_date,
            "image"=> $this->image,
        ];
    }
}
