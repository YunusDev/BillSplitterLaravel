<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'name' =>  $this->name,
            'email' =>  $this->email,
            'phone' =>  $this->phone,
            'isAdmin' =>  $this->isAdmin() == true ? 'Admin' : 'Not Admin',
            'verified' =>  $this->verified == '1' ? 'Verified' : 'Not Verified',
            'created_at' => (string) $this->created_at->diffForHumans()



        ];
    }
}
