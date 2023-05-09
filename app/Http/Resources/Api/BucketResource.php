<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class BucketResource extends JsonResource
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
            'id'=>$this->id,
            'cloth_name' => $this->cloth->name,
            'cloth_id'=>$this->cloth_id,
            'cloth_category_id'=>$this->cloth_category_id,
            'rate'=>$this->cloth->rate,
            'total_price'=>(float)($this->cloth->rate*$this->count),
            'count'=>$this->count
        ];
    }
}
