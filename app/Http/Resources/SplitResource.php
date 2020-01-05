<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SplitResource extends JsonResource
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
            'email' => $this->email,
            'code' => $this->code,
            'settled' => $this->settled,
            'percentage' => $this->percentage,
            'amount' => $this->amount,
            'bill' => $this->bill,
            'products' => $this->billSplit($this->bill->id, $this->email),
            'created_at' => $this->created_at->diffForHumans()

        ];
    }
}
