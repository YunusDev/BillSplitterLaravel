<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BillCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[

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
