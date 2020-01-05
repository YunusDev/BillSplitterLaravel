<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Split extends Model
{
    //
    protected $guarded = [];

    public function bill(){

        return $this->belongsTo(Bill::class);

    }

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function billSplit($bill_id, $split_email){

         return Product::where('bill_id', $bill_id)->where('email', $split_email)->get();

    }
}
