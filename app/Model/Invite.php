<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    //
    protected $fillable = [ 'email', 'token' ];

    protected $appends = ['frontend_invite_url'];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function getFrontendInviteUrlAttribute(){

        return 'http://localhost:8080/invite/' . strval($this->token);

    }
}
