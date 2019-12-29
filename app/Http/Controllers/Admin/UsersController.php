<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\UsersCollection;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    //

    public function __construct(){

        $this->middleware('auth:api');

    }

    public function index(){

        $users = User::latest()->get();

        $usersCollection = UsersCollection::collection($users);

        return json_encode($usersCollection);

    }
}
