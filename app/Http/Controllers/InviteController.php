<?php

namespace App\Http\Controllers;

use App\Mail\InviteUser;
use App\Model\Invite;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InviteController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        $this->middleware('auth:api')->except('accept');
    }

    public function send(Request $request){

        $this->validate(request(), [

           'email' => 'required'

        ]);

        do{

            $token = str_random(25);

        }while(Invite::where('token', $token)->first());


        $invite = new Invite;

        $invite->email = $request->email;
        $invite->token = $token;
//        $invite->user_id  = 1;
        $invite->user_id  = auth('api')->id();


        Mail::to($request->email)->send(new InviteUser($invite));

        $invite->save();

        return  $this->showOne($invite);

    }

    public function accept($token){


        if (!$invite = Invite::where('token', $token)->first()) {

            $this->errorResponse('The Invite does not exist!', 401);

        }

        return $invite;

    }
}
