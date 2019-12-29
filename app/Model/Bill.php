<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //


    protected $guarded = [];

//    protected $appends = ['userd'];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function products(){

        return $this->hasMany(Product::class);

    }

    public function splits(){

        return $this->hasMany(Split::class);

    }

    public function users(){

        return $this->belongsToMany(User::class, 'bill_user')->withTimestamps()->orderBy('created_at','DESC');
    }

    public function splitsWithUser(){


        $arr = [];

        foreach ($this->splits as $split){

            $object = (object) [

                'id' => $split->id,
                'user_id' => $split->user_id,
                'bill_id' => $split->bill_id,
                'amount' => $split->amount,
                'settled' => $split->settled,
                'percentage' => $split->percentage,
                'user' => $split->user

            ];

            array_push($arr, $object);

        }

        return $arr;

    }


}
