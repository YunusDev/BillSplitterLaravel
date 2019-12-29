<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [

        'id' => $this->id,
        'name' =>  'You',
        'real_name' =>  $this->name,
        'email' =>  $this->email,
        'phone' =>  $this->phone,
        'is_admin' =>  $this->is_admin,
        'verified' =>  $this->verified,
        'created_at' => $this->created_at->diffForHumans()

        ];
    }
}
