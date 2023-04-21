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
            // 'gender' => $this->gender,
            'email' => $this->email,
            'image' => $this->image,
            'address' => $this->address,
            // 'added_by' => $this->added_by,
            // 'college_id' => $this->college_id,
            // 'college' => CollegeResource::make($this->college),
            // 'status' => $this->status,
            // 'permissions' => PermissionResource::collection($this->getAllPermissions()),
            // 'roles' => RoleSimpleResource::make($this->roles->first()),
            // 'pwd_reset' => $this->pwd_reset,
            // 'created_at' => Carbon::parse($this->created_at)->format('d-M-Y'),
            // 'photo' => FileStorage::getLatestLink($this->getMedia('user_photo')),
        ];
    }
}
