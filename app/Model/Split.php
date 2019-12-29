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
}
