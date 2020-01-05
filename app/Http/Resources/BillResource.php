<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'name' =>  $this->name,
            'split_method' =>  $this->split_method,
            'total_price' =>  $this->total_price,
            'user' => $this->user,
            'users' => $this->users,
            'products'=> $this->products,
            'splits'=> $this->splits,
            'splitting'=> $this->splitsWithUser(),
            'created_at' => (string) $this->created_at->diffForHumans()

        ];
    }
}
